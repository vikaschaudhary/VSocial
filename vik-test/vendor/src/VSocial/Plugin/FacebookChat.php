<?php
namespace VSocial\Plugin;

class FacebookChat {

    const STREAM_XML = '<stream:stream xmlns:stream="http://etherx.jabber.org/streams" version="1.0" xmlns="jabber:client" to="chat.facebook.com" xml:lang="en" xmlns:xml="http://www.w3.org/XML/1998/namespace">';
    const AUTH_XML = '<auth xmlns="urn:ietf:params:xml:ns:xmpp-sasl" mechanism="X-FACEBOOK-PLATFORM"></auth>';
    const CLOSE_XML = '</stream:stream>';
    const RESOURCE_XML = '<iq type="set" id="3"><bind xmlns="urn:ietf:params:xml:ns:xmpp-bind"><resource>fb_xmpp_script</resource></bind></iq>';
    const SESSION_XML = '<iq type="set" id="4" to="chat.facebook.com"><session xmlns="urn:ietf:params:xml:ns:xmpp-session"/></iq>';
    const START_TLS = '<starttls xmlns="urn:ietf:params:xml:ns:xmpp-tls"/>';

    protected $access_token;
    protected $app_id;
    protected $debug = false;
    protected $uid;
    protected $toid;

    public function open_connection ($server) {
        if ($this->debug) {
            print "[INFO] Opening connection... ";
        }
        $fp = fsockopen($server, 5222, $errno, $errstr);
        if (!$fp) {
            if ($this->debug) {
                print "$errstr ($errno)<br>";
            }
        } else {
            if ($this->debug) {
                print "connnection open<br>";
            }
        }

        return $fp;
    }

    public function send_xml ($fp, $xml) {
        fwrite($fp, $xml);
    }

    public function recv_xml ($fp, $size = 4096) {
        $xml = fread($fp, $size);
        if ($xml === "") {
            return null;
        }


        $xml_parser = xml_parser_create();
        xml_parse_into_struct($xml_parser, $xml, $val, $index);
        xml_parser_free($xml_parser);

        return array($val, $index);
    }

    public function find_xmpp ($fp, $tag, $value = null, &$ret = null) {
        static $val = null, $index = null;

        do {
            if ($val === null && $index === null) {
                list($val, $index) = $this->recv_xml($fp);
                if ($val === null || $index === null) {
                    return false;
                }
            }

            foreach ($index as $tag_key => $tag_array) {
                if ($tag_key === $tag) {
                    if ($value === null) {
                        if (isset($val[$tag_array[0]]['value'])) {
                            $ret = $val[$tag_array[0]]['value'];
                        }
                        return true;
                    }
                    foreach ($tag_array as $i => $pos) {
                        if ($val[$pos]['tag'] === $tag && isset($val[$pos]['value']) &&
                                $val[$pos]['value'] === $value) {
                            $ret = $val[$pos]['value'];
                            return true;
                        }
                    }
                }
            }
            $val = $index = null;
        } while (!feof($fp));

        return false;
    }

    public function xmpp_connect ($options, $access_token) {
        $fp = $this->open_connection($options['server']);
        if (!$fp) {
            return false;
        }

        /**
         *  initiates auth process (using X-FACEBOOK_PLATFORM)
         */
        $this->send_xml($fp, self::STREAM_XML);
        if (!$this->find_xmpp($fp, 'STREAM:STREAM')) {
            return false;
        }
        if (!$this->find_xmpp($fp, 'MECHANISM', 'X-FACEBOOK-PLATFORM')) {
            return false;
        }

        /**
         *  starting tls - MANDATORY TO USE OAUTH TOKEN!!!!
         */
        $this->send_xml($fp, self::START_TLS);
        if (!$this->find_xmpp($fp, 'PROCEED', null, $proceed)) {
            return false;
        }
        stream_socket_enable_crypto($fp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);

        $this->send_xml($fp, self::STREAM_XML);
        if (!$this->find_xmpp($fp, 'STREAM:STREAM')) {
            return false;
        }
        if (!$this->find_xmpp($fp, 'MECHANISM', 'X-FACEBOOK-PLATFORM')) {
            return false;
        }

        /**
         *  gets challenge from server and decode it
         */
        $this->send_xml($fp, self::AUTH_XML);
        if (!$this->find_xmpp($fp, 'CHALLENGE', null, $challenge)) {
            return false;
        }
        $challenge = urldecode(base64_decode($challenge));
        $challenge = urldecode($challenge);
        parse_str($challenge, $challenge_array);

        /**
         *  creates the response array
         */
        $resp_array = array(
            'method' => $challenge_array['method'],
            'nonce' => $challenge_array['nonce'],
            'access_token' => $access_token,
            'api_key' => $options['app_id'],
            'call_id' => 0,
            'v' => '1.0',
        );
        /**
         *  creates signature
         */
        $response = http_build_query($resp_array);

        /**
         *  sends the response and waits for success
         */
        $xml = '<response xmlns="urn:ietf:params:xml:ns:xmpp-sasl">' . base64_encode($response) . '</response>';
        $this->send_xml($fp, $xml);
        if (!$this->find_xmpp($fp, 'SUCCESS')) {
            return false;
        }

        /**
         *  finishes auth process
         */
        $this->send_xml($fp, self::STREAM_XML);
        if (!$this->find_xmpp($fp, 'STREAM:STREAM')) {
            return false;
        }
        if (!$this->find_xmpp($fp, 'STREAM:FEATURES')) {
            return false;
        }
        $this->send_xml($fp, self::RESOURCE_XML);
        if (!$this->find_xmpp($fp, 'JID')) {
            return false;
        }
        $this->send_xml($fp, self::SESSION_XML);
        if (!$this->find_xmpp($fp, 'SESSION')) {
            return false;
        }
        /**
         * http://stackoverflow.com/questions/15813542/facebook-xmpp-chat-api-send-message-php?rq=1
         */
        $message = $options['message'];
        $msg_xaml = "<message type='chat' from='-{$this->uid}@chat.facebook.com' to='-{$this->toid}@chat.facebook.com'>";
        #$msg_xaml = "<message type='chat' from='-100005004307869@chat.facebook.com' to='-100003472047915@chat.facebook.com'>";
        $msg_xaml .= "<body>{$message}</body>";
        $msg_xaml .= "</message>";

        $this->send_xml($fp, $msg_xaml);
        if (!$this->find_xmpp($fp, 'BODY')) {
            if ($this->debug) {
                print ("Message Sending failed<br>");
            }
            return false;
        }
        /**
         *  we made it!
         */
        $this->send_xml($fp, self::CLOSE_XML);
        if ($this->debug) {
            print ("Authentication complete<br>");
        }



        fclose($fp);

        return true;
    }

    public function get_access_token () {
        return $this->access_token;
    }

    public function __construct ($uid, $toid, $message, $app_id, $access_token) {

        $this->app_id = $app_id;
        $this->uid = trim($uid);
        $this->toid = trim($toid);
        $this->access_token = $access_token;



        $options = array(
            'uid' => $this->uid,
            'app_id' => $this->app_id,
            'server' => 'chat.facebook.com',
            'message' => $message,
        );

        $connect = $this->xmpp_connect($options, $this->access_token);
        if ($this->debug) {
            if ($connect) {
                print "Done<br>";
            } else {
                print "An error ocurred<br>";
            }
        }
    }

}