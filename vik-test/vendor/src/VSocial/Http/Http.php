<?php
namespace VSocial\Http;

class Http {

    const HTTP_CLIENT_ERROR_UNSPECIFIED_ERROR = -1;
    const HTTP_CLIENT_ERROR_NO_ERROR = 0;
    const HTTP_CLIENT_ERROR_INVALID_SERVER_ADDRESS = 1;
    const HTTP_CLIENT_ERROR_CANNOT_CONNECT = 2;
    const HTTP_CLIENT_ERROR_COMMUNICATION_FAILURE = 3;
    const HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE = 4;
    const HTTP_CLIENT_ERROR_PROTOCOL_FAILURE = 5;
    const HTTP_CLIENT_ERROR_INVALID_PARAMETERS = 6;

    protected $host_name = "";
    protected $host_port = 0;
    protected $proxy_host_name = "";
    protected $proxy_host_port = 80;
    protected $socks_host_name = '';
    protected $socks_host_port = 1080;
    protected $socks_version = '5';
    protected $protocol = "http";
    protected $request_method = "GET";
    protected $user_agent = 'httpclient (http://www.phpclasses.org/httpclient $Revision: 1.90 $)';
    protected $accept = '';
    protected $authentication_mechanism = "";
    protected $user;
    protected $password;
    protected $realm;
    protected $workstation;
    protected $proxy_authentication_mechanism = "";
    protected $proxy_user;
    protected $proxy_password;
    protected $proxy_realm;
    protected $proxy_workstation;
    protected $request_uri = "";
    protected $request = "";
    protected $request_headers = array();
    protected $request_user;
    protected $request_password;
    protected $request_realm;
    protected $request_workstation;
    protected $proxy_request_user;
    protected $proxy_request_password;
    protected $proxy_request_realm;
    protected $proxy_request_workstation;
    protected $request_body = "";
    protected $request_arguments = array();
    protected $protocol_version = "1.1";
    protected $timeout = 0;
    protected $data_timeout = 0;
    protected $debug = 0;
    protected $log_debug = 0;
    protected $debug_response_body = 1;
    protected $html_debug = 0;
    protected $support_cookies = 1;
    protected $cookies = array();
    protected $error = "";
    protected $error_code = self::HTTP_CLIENT_ERROR_NO_ERROR;
    protected $exclude_address = "";
    protected $follow_redirect = 0;
    protected $redirection_limit = 5;
    protected $response_status = "";
    protected $response_message = "";
    protected $file_buffer_length = 8000;
    protected $force_multipart_form_post = 0;
    protected $prefer_curl = 0;
    protected $keep_alive = 1;
    protected $sasl_authenticate = 1;

    /* private protectediables - DO NOT ACCESS */
    protected $state = "disconnected";
    protected $use_curl = 0;
    protected $connection = 0;
    protected $content_length = 0;
    protected $response = "";
    protected $read_response = 0;
    protected $read_length = 0;
    protected $request_host = "";
    protected $next_token = "";
    protected $redirection_level = 0;
    protected $chunked = 0;
    protected $remaining_chunk = 0;
    protected $last_chunk_read = 0;
    protected $months = array(
        "Jan" => "01",
        "Feb" => "02",
        "Mar" => "03",
        "Apr" => "04",
        "May" => "05",
        "Jun" => "06",
        "Jul" => "07",
        "Aug" => "08",
        "Sep" => "09",
        "Oct" => "10",
        "Nov" => "11",
        "Dec" => "12");
    protected $session = '';
    protected $connection_close = 0;
    protected $force_close = 0;
    protected $connected_host = '';
    protected $connected_port = -1;
    protected $connected_ssl = 0;

    const TYPE_INTEGER = "integer";
    const ERROR_SERVER_DISCONNECTED = ": the server disconnected";
    const ERROR_DATA_ACCESS_TIMEOUT = ": data access time out";

    public function __construct () {
        ;
    }

    public function tokenize ($string, $separator = "") {
        if (!strcmp($separator, "")) {
            $separator = $string;
            $string = $this->next_token;
        }
        for ($character = 0; $character < strlen($separator); $character++) {
            if (gettype($position = strpos($string, $separator[$character])) == self::TYPE_INTEGER)
                $found = (isset($found) ? min($found, $position) : $position);
        }
        if (isset($found)) {
            $this->next_token = substr($string, $found + 1);
            return(substr($string, 0, $found));
        } else {
            $this->next_token = "";
            return($string);
        }
    }

    public function cookieEncode ($value, $name) {
        return($name ? str_replace("=", "%25", $value) : str_replace(";", "%3B", $value));
    }

    public function setError ($error, $error_code = self::HTTP_CLIENT_ERROR_UNSPECIFIED_ERROR) {
        $this->error_code = $error_code;
        return($this->error = $error);
    }

    public function setPHPError ($error, &$php_error_message, $error_code = self::HTTP_CLIENT_ERROR_UNSPECIFIED_ERROR) {
        if (isset($php_error_message) && strlen($php_error_message))
            $error.=": " . $php_error_message;
        return($this->setError($error, $error_code));
    }

    public function setDataAccessError ($error, $check_connection = 0) {
        $this->error = $error;
        $this->error_code = self::HTTP_CLIENT_ERROR_COMMUNICATION_FAILURE;
        if (!$this->use_curl && function_exists("socket_get_status")) {
            $status = socket_get_status($this->connection);
            if ($status["timed_out"])
                $this->error.= self::ERROR_DATA_ACCESS_TIMEOUT;
            elseif ($status["eof"]) {
                if ($check_connection)
                    $this->error = "";
                else
                    $this->error.=self::ERROR_SERVER_DISCONNECTED;
            }
        }
    }

    public function outputDebug ($message) {
        if ($this->log_debug)
            error_log($message);
        else {
            $message.=PHP_EOL;
            if ($this->html_debug)
                $message = str_replace(PHP_EOL, "<br />\n", htmlentities($message));
            echo $message;
            flush();
        }
    }

    public function getLine () {
        for ($line = "";;) {
            if ($this->use_curl) {
                $eol = strpos($this->response, PHP_EOL, $this->read_response);
                $data = ($eol ? substr($this->response, $this->read_response, $eol + 1 - $this->read_response) : "");
                $this->read_response+=strlen($data);
            } else {
                if (feof($this->connection)) {
                    $this->setDataAccessError("reached the end of data while reading from the HTTP server connection");
                    return(0);
                }
                $data = fgets($this->connection, 100);
            }
            if (GetType($data) != "string" || strlen($data) == 0) {
                $this->setDataAccessError("it was not possible to read line from the HTTP server");
                return(0);
            }
            $line.=$data;
            $length = strlen($line);
            if ($length && !strcmp(substr($line, $length - 1, 1), PHP_EOL)) {
                $length-=(($length >= 2 && !strcmp(substr($line, $length - 2, 1), "\r")) ? 2 : 1);
                $line = substr($line, 0, $length);
                if ($this->debug)
                    $this->outputDebug("S $line");
                return($line);
            }
        }
    }

    public function putLine ($line) {
        if ($this->debug)
            $this->outputDebug("C $line");
        if (!fputs($this->connection, $line . "\r\n")) {
            $this->setDataAccessError("it was not possible to send a line to the HTTP server");
            return(0);
        }
        return(1);
    }

    public function putData ($data) {
        if (strlen($data)) {
            if ($this->debug)
                $this->outputDebug('C ' . $data);
            if (!fputs($this->connection, $data)) {
                $this->setDataAccessError("it was not possible to send data to the HTTP server");
                return(0);
            }
        }
        return(1);
    }

    public function flushData () {
        if (!fflush($this->connection)) {
            $this->setDataAccessError("it was not possible to send data to the HTTP server");
            return(0);
        }
        return(1);
    }

    public function readChunkSize () {
        if ($this->remaining_chunk == 0) {
            $debug = $this->debug;
            if (!$this->debug_response_body)
                $this->debug = 0;
            $line = $this->getLine();
            $this->debug = $debug;
            if (GetType($line) != "string")
                return($this->setError("could not read chunk start: " . $this->error, $this->error_code));
            $this->remaining_chunk = hexdec($line);
            if ($this->remaining_chunk == 0) {
                if (!$this->debug_response_body)
                    $this->debug = 0;
                $line = $this->getLine();
                $this->debug = $debug;
                if (GetType($line) != "string")
                    return($this->setError("could not read chunk end: " . $this->error, $this->error_code));
            }
        }
        return("");
    }

    public function readBytes ($length) {
        if ($this->use_curl) {
            $bytes = substr($this->response, $this->read_response, min($length, strlen($this->response) - $this->read_response));
            $this->read_response+=strlen($bytes);
            if ($this->debug && $this->debug_response_body && strlen($bytes))
                $this->outputDebug("S " . $bytes);
        }
        else {
            if ($this->chunked) {
                for ($bytes = "", $remaining = $length; $remaining;) {
                    if (strlen($this->readChunkSize()))
                        return("");
                    if ($this->remaining_chunk == 0) {
                        $this->last_chunk_read = 1;
                        break;
                    }
                    $ask = min($this->remaining_chunk, $remaining);
                    $chunk = @fread($this->connection, $ask);
                    $read = strlen($chunk);
                    if ($read == 0) {
                        $this->setDataAccessError("it was not possible to read data chunk from the HTTP server");
                        return("");
                    }
                    if ($this->debug && $this->debug_response_body)
                        $this->outputDebug("S " . $chunk);
                    $bytes.=$chunk;
                    $this->remaining_chunk-=$read;
                    $remaining-=$read;
                    if ($this->remaining_chunk == 0) {
                        if (feof($this->connection))
                            return($this->setError("reached the end of data while reading the end of data chunk mark from the HTTP server", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                        $data = @fread($this->connection, 2);
                        if (strcmp($data, "\r\n")) {
                            $this->setDataAccessError("it was not possible to read end of data chunk from the HTTP server");
                            return("");
                        }
                    }
                }
            } else {
                $bytes = @fread($this->connection, $length);
                if (strlen($bytes)) {
                    if ($this->debug && $this->debug_response_body)
                        $this->outputDebug("S " . $bytes);
                }
                else
                    $this->setDataAccessError("it was not possible to read data from the HTTP server", $this->connection_close);
            }
        }
        return($bytes);
    }

    public function endOfInput () {
        if ($this->use_curl)
            return($this->read_response >= strlen($this->response));
        if ($this->chunked)
            return($this->last_chunk_read);
        if ($this->content_length_set)
            return($this->content_length <= $this->read_length);
        return(feof($this->connection));
    }

    public function resolve ($domain, &$ip, $server_type) {
        if (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $domain))
            $ip = $domain;
        else {
            if ($this->debug)
                $this->outputDebug('Resolving ' . $server_type . ' server domain "' . $domain . '"...');
            if (!strcmp($ip = @gethostbyname($domain), $domain))
                $ip = "";
        }
        if (strlen($ip) == 0 || (strlen($this->exclude_address) && !strcmp(@gethostbyname($this->exclude_address), $ip)))
            return($this->setError("could not resolve the host domain \"" . $domain . "\"", self::HTTP_CLIENT_ERROR_INVALID_SERVER_ADDRESS));
        return('');
    }

    public function connect ($host_name, $host_port, $ssl, $server_type = 'HTTP') {
        $domain = $host_name;
        $port = $host_port;
        if (strlen($error = $this->resolve($domain, $ip, $server_type)))
            return($error);
        if (strlen($this->socks_host_name)) {
            switch ($this->socks_version) {
                case '4':
                    $version = 4;
                    break;
                case '5':
                    $version = 5;
                    break;
                default:
                    return('it was not specified a supported SOCKS protocol version');
                    break;
            }
            $host_ip = $ip;
            $port = $this->socks_host_port;
            $host_server_type = $server_type;
            $server_type = 'SOCKS';
            if (strlen($error = $this->resolve($this->socks_host_name, $ip, $server_type)))
                return($error);
        }
        if ($this->debug)
            $this->outputDebug('connecting to ' . $server_type . ' server IP ' . $ip . ' port ' . $port . '...');
        if ($ssl)
            $ip = "ssl://" . $host_name;
        if (($this->connection = ($this->timeout ? @fsockopen($ip, $port, $errno, $error, $this->timeout) : @fsockopen($ip, $port, $errno))) == 0) {
            $error_code = self::HTTP_CLIENT_ERROR_CANNOT_CONNECT;
            switch ($errno) {
                case -3:
                    return($this->setError("socket could not be created", $error_code));
                case -4:
                    return($this->setError("dns lookup on hostname \"" . $host_name . "\" failed", $error_code));
                case -5:
                    return($this->setError("connection refused or timed out", $error_code));
                case -6:
                    return($this->setError("fdopen() call failed", $error_code));
                case -7:
                    return($this->setError("setvbuf() call failed", $error_code));
                default:
                    return($this->setPHPError($errno . " could not connect to the host \"" . $host_name . "\"", $php_errormsg, $error_code));
            }
        } else {
            if ($this->data_timeout && function_exists("socket_set_timeout"))
                socket_set_timeout($this->connection, $this->data_timeout, 0);
            if (strlen($this->socks_host_name)) {
                if ($this->debug)
                    $this->outputDebug('connected to the SOCKS server ' . $this->socks_host_name);
                $send_error = 'it was not possible to send data to the SOCKS server';
                $receive_error = 'it was not possible to receive data from the SOCKS server';
                switch ($version) {
                    case 4:
                        $command = 1;
                        $user = '';
                        if (!fputs($this->connection, chr($version) . chr($command) . pack('nN', $host_port, ip2long($host_ip)) . $user . Chr(0)))
                            $error = $this->setDataAccessError($send_error);
                        else {
                            $response = fgets($this->connection, 9);
                            if (strlen($response) != 8)
                                $error = $this->setDataAccessError($receive_error);
                            else {
                                $socks_errors = array(
                                    "\x5a" => '',
                                    "\x5b" => 'request rejected',
                                    "\x5c" => 'request failed because client is not running identd (or not reachable from the server)',
                                    "\x5d" => 'request failed because client\'s identd could not confirm the user ID string in the request',
                                );
                                $error_code = $response[1];
                                $error = (isset($socks_errors[$error_code]) ? $socks_errors[$error_code] : 'unknown');
                                if (strlen($error))
                                    $error = 'SOCKS error: ' . $error;
                            }
                        }
                        break;
                    case 5:
                        if ($this->debug)
                            $this->outputDebug('Negotiating the authentication method ...');
                        $methods = 1;
                        $method = 0;
                        if (!fputs($this->connection, chr($version) . chr($methods) . chr($method)))
                            $error = $this->setDataAccessError($send_error);
                        else {
                            $response = fgets($this->connection, 3);
                            if (strlen($response) != 2)
                                $error = $this->setDataAccessError($receive_error);
                            elseif (Ord($response[1]) != $method)
                                $error = 'the SOCKS server requires an authentication method that is not yet supported';
                            else {
                                if ($this->debug)
                                    $this->outputDebug('connecting to ' . $host_server_type . ' server IP ' . $host_ip . ' port ' . $host_port . '...');
                                $command = 1;
                                $address_type = 1;
                                if (!fputs($this->connection, chr($version) . chr($command) . "\x00" . chr($address_type) . pack('Nn', ip2long($host_ip), $host_port)))
                                    $error = $this->setDataAccessError($send_error);
                                else {
                                    $response = fgets($this->connection, 11);
                                    if (strlen($response) != 10)
                                        $error = $this->setDataAccessError($receive_error);
                                    else {
                                        $socks_errors = array(
                                            "\x00" => '',
                                            "\x01" => 'general SOCKS server failure',
                                            "\x02" => 'connection not allowed by ruleset',
                                            "\x03" => 'Network unreachable',
                                            "\x04" => 'Host unreachable',
                                            "\x05" => 'connection refused',
                                            "\x06" => 'TTL expired',
                                            "\x07" => 'Command not supported',
                                            "\x08" => 'Address type not supported'
                                        );
                                        $error_code = $response[1];
                                        $error = (isset($socks_errors[$error_code]) ? $socks_errors[$error_code] : 'unknown');
                                        if (strlen($error))
                                            $error = 'SOCKS error: ' . $error;
                                    }
                                }
                            }
                        }
                        break;
                    default:
                        $error = 'support for SOCKS protocol version ' . $this->socks_version . ' is not yet implemented';
                        break;
                }
                if (strlen($error)) {
                    fclose($this->connection);
                    return($error);
                }
            }
            if ($this->debug)
                $this->outputDebug("connected to $host_name");
            if (strlen($this->proxy_host_name) && !strcmp(strtolower($this->protocol), 'https')) {
                if (function_exists('stream_socket_enable_crypto') && in_array('ssl', stream_get_transports()))
                    $this->state = "connectedToProxy";
                else {
                    $this->outputDebug("It is not possible to start SSL after connecting to the proxy server. If the proxy refuses to forward the SSL request, you may need to upgrade to PHP 5.1 or later with openSSL support enabled.");
                    $this->state = "connected";
                }
            }
            else
                $this->state = "connected";
            return("");
        }
    }

    public function disconnect () {
        if ($this->debug)
            $this->outputDebug("disconnected from " . $this->connected_host);
        if ($this->use_curl) {
            curl_close($this->connection);
            $this->response = "";
        }
        else
            fclose($this->connection);
        $this->state = "disconnected";
        return("");
    }

    public function getRequestArguments ($url, &$arguments) {
        $this->error = '';
        $this->error_code = self::HTTP_CLIENT_ERROR_NO_ERROR;
        $arguments = array();
        $url = str_replace(' ', '%20', $url);
        $parameters = @parse_url($url);
        if (!$parameters)
            return($this->setError("it was not specified a valid URL", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        if (!isset($parameters["scheme"]))
            return($this->setError("it was not specified the protocol type argument", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        switch (strtolower($parameters["scheme"])) {
            case "http":
            case "https":
                $arguments["Protocol"] = $parameters["scheme"];
                break;
            default:
                return($parameters["scheme"] . " connection scheme is not yet supported");
        }
        if (!isset($parameters["host"]))
            return($this->setError("it was not specified the connection host argument", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        $arguments["HostName"] = $parameters["host"];
        $arguments["Headers"] = array("Host" => $parameters["host"] . (isset($parameters["port"]) ? ":" . $parameters["port"] : ""));
        if (isset($parameters["user"])) {
            $arguments["AuthUser"] = UrlDecode($parameters["user"]);
            if (!isset($parameters["pass"]))
                $arguments["AuthPassword"] = "";
        }
        if (isset($parameters["pass"])) {
            if (!isset($parameters["user"]))
                $arguments["AuthUser"] = "";
            $arguments["AuthPassword"] = UrlDecode($parameters["pass"]);
        }
        if (isset($parameters["port"])) {
            if (strcmp($parameters["port"], strval(intval($parameters["port"]))))
                return($this->setError("it was not specified a valid connection host argument", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            $arguments["HostPort"] = intval($parameters["port"]);
        }
        else
            $arguments["HostPort"] = 0;
        $arguments["RequestURI"] = (isset($parameters["path"]) ? $parameters["path"] : "/") . (isset($parameters["query"]) ? "?" . $parameters["query"] : "");
        if (strlen($this->user_agent))
            $arguments["Headers"]["User-Agent"] = $this->user_agent;
        if (strlen($this->accept))
            $arguments["Headers"]["Accept"] = $this->accept;
        return("");
    }

    public function open ($arguments) {
        if (strlen($this->error))
            return($this->error);
        $error_code = self::HTTP_CLIENT_ERROR_UNSPECIFIED_ERROR;
        if (isset($arguments["HostName"]))
            $this->host_name = $arguments["HostName"];
        if (isset($arguments["HostPort"]))
            $this->host_port = $arguments["HostPort"];
        if (isset($arguments["ProxyHostName"]))
            $this->proxy_host_name = $arguments["ProxyHostName"];
        if (isset($arguments["ProxyHostPort"]))
            $this->proxy_host_port = $arguments["ProxyHostPort"];
        if (isset($arguments["SOCKSHostName"]))
            $this->socks_host_name = $arguments["SOCKSHostName"];
        if (isset($arguments["SOCKSHostPort"]))
            $this->socks_host_port = $arguments["SOCKSHostPort"];
        if (isset($arguments["SOCKSVersion"]))
            $this->socks_version = $arguments["SOCKSVersion"];
        if (isset($arguments["Protocol"]))
            $this->protocol = $arguments["Protocol"];
        switch (strtolower($this->protocol)) {
            case "http":
                $default_port = 80;
                break;
            case "https":
                $default_port = 443;
                break;
            default:
                return($this->setError("it was not specified a valid connection protocol", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        }
        if (strlen($this->proxy_host_name) == 0) {
            if (strlen($this->host_name) == 0)
                return($this->setError("it was not specified a valid hostname", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            $host_name = $this->host_name;
            $host_port = ($this->host_port ? $this->host_port : $default_port);
            $server_type = 'HTTP';
        }
        else {
            $host_name = $this->proxy_host_name;
            $host_port = $this->proxy_host_port;
            $server_type = 'HTTP proxy';
        }
        $ssl = (strtolower($this->protocol) == "https" && strlen($this->proxy_host_name) == 0);
        if ($ssl && strlen($this->socks_host_name))
            return($this->setError('establishing SSL connections via a SOCKS server is not yet supported', self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        $this->use_curl = ($ssl && $this->prefer_curl && function_exists("curl_init"));
        switch ($this->state) {
            case 'connected':
                if (!strcmp($host_name, $this->connected_host) && intval($host_port) == $this->connected_port && intval($ssl) == $this->connected_ssl) {
                    if ($this->debug)
                        $this->outputDebug("Reusing connection to " . $this->connected_host);
                    return('');
                }
                if (strlen($error = $this->disconnect()))
                    return($error);
            case "disconnected":
                break;
            default:
                return("1 already connected");
        }
        if ($this->debug)
            $this->outputDebug("connecting to " . $this->host_name);
        if ($this->use_curl) {
            $error = (($this->connection = curl_init($this->protocol . "://" . $this->host_name . ($host_port == $default_port ? "" : ":" . strval($host_port)) . "/")) ? "" : "Could not initialize a CURL session");
            if (strlen($error) == 0) {
                if (isset($arguments["SSLCertificateFile"]))
                    curl_setopt($this->connection, CURLOPT_SSLCERT, $arguments["SSLCertificateFile"]);
                if (isset($arguments["SSLCertificatePassword"]))
                    curl_setopt($this->connection, CURLOPT_SSLCERTPASSWD, $arguments["SSLCertificatePassword"]);
                if (isset($arguments["SSLKeyFile"]))
                    curl_setopt($this->connection, CURLOPT_SSLKEY, $arguments["SSLKeyFile"]);
                if (isset($arguments["SSLKeyPassword"]))
                    curl_setopt($this->connection, CURLOPT_SSLKEYPASSWD, $arguments["SSLKeyPassword"]);
            }
            $this->state = "connected";
        }
        else {
            $error = "";
            if (strlen($this->proxy_host_name) && (isset($arguments["SSLCertificateFile"]) || isset($arguments["SSLCertificateFile"])))
                $error = "establishing SSL connections using certificates or private keys via non-SSL proxies is not supported";
            else {
                if ($ssl) {
                    if (isset($arguments["SSLCertificateFile"]))
                        $error = "establishing SSL connections using certificates is only supported when the cURL extension is enabled";
                    elseif (isset($arguments["SSLKeyFile"]))
                        $error = "establishing SSL connections using a private key is only supported when the cURL extension is enabled";
                    else {
                        $version = explode(".", function_exists("phpversion") ? phpversion() : "3.0.7");
                        $php_version = intval($version[0]) * 1000000 + intval($version[1]) * 1000 + intval($version[2]);
                        if ($php_version < 4003000)
                            $error = "establishing SSL connections requires at least PHP version 4.3.0 or having the cURL extension enabled";
                        elseif (!function_exists("extension_loaded") || !extension_loaded("openssl"))
                            $error = "establishing SSL connections requires the openSSL extension enabled";
                    }
                }
                if (strlen($error) == 0) {
                    $error = $this->connect($host_name, $host_port, $ssl, $server_type);
                    $error_code = $this->error_code;
                }
            }
        }
        if (strlen($error))
            return($this->setError($error, $error_code));
        $this->session = md5(uniqid(""));
        $this->connected_host = $host_name;
        $this->connected_port = intval($host_port);
        $this->connected_ssl = intval($ssl);
        return("");
    }

    public function close ($force = 0) {
        if ($this->state == "disconnected")
            return("1 already disconnected");
        if (!$this->force_close && $this->keep_alive && !$force && $this->state == 'ResponseReceived') {
            if ($this->debug)
                $this->outputDebug('Keeping the connection alive to ' . $this->connected_host);
            $this->state = 'connected';
            return('');
        }
        return($this->disconnect());
    }

    public function pickCookies (&$cookies, $secure) {
        if (isset($this->cookies[$secure])) {
            $now = gmdate("Y-m-d H-i-s");
            for ($domain = 0, Reset($this->cookies[$secure]); $domain < count($this->cookies[$secure]); Next($this->cookies[$secure]), $domain++) {
                $domain_pattern = Key($this->cookies[$secure]);
                $match = strlen($this->request_host) - strlen($domain_pattern);
                if ($match >= 0 && !strcmp($domain_pattern, substr($this->request_host, $match)) && ($match == 0 || $domain_pattern[0] == "." || $this->request_host[$match - 1] == ".")) {
                    for (Reset($this->cookies[$secure][$domain_pattern]), $path_part = 0; $path_part < count($this->cookies[$secure][$domain_pattern]); Next($this->cookies[$secure][$domain_pattern]), $path_part++) {
                        $path = Key($this->cookies[$secure][$domain_pattern]);
                        if (strlen($this->request_uri) >= strlen($path) && substr($this->request_uri, 0, strlen($path)) == $path) {
                            for (Reset($this->cookies[$secure][$domain_pattern][$path]), $cookie = 0; $cookie < count($this->cookies[$secure][$domain_pattern][$path]); Next($this->cookies[$secure][$domain_pattern][$path]), $cookie++) {
                                $cookie_name = Key($this->cookies[$secure][$domain_pattern][$path]);
                                $expires = $this->cookies[$secure][$domain_pattern][$path][$cookie_name]["expires"];
                                if ($expires == "" || strcmp($now, $expires) < 0)
                                    $cookies[$cookie_name] = $this->cookies[$secure][$domain_pattern][$path][$cookie_name];
                            }
                        }
                    }
                }
            }
        }
    }

    public function getFileDefinition ($file, &$definition) {
        $name = "";
        if (isset($file["FileName"]))
            $name = basename($file["FileName"]);
        if (isset($file["Name"]))
            $name = $file["Name"];
        if (strlen($name) == 0)
            return("it was not specified the file part name");
        if (isset($file["Content-Type"])) {
            $content_type = $file["Content-Type"];
            $type = $this->Tokenize(strtolower($content_type), "/");
            $sub_type = $this->Tokenize("");
            switch ($type) {
                case "text":
                case "image":
                case "audio":
                case "video":
                case "application":
                case "message":
                    break;
                case "automatic":
                    switch ($sub_type) {
                        case "name":
                            switch (GetType($dot = strrpos($name, ".")) == "integer" ? strtolower(substr($name, $dot)) : "") {
                                case ".xls":
                                    $content_type = "application/excel";
                                    break;
                                case ".hqx":
                                    $content_type = "application/macbinhex40";
                                    break;
                                case ".doc":
                                case ".dot":
                                case ".wrd":
                                    $content_type = "application/msword";
                                    break;
                                case ".pdf":
                                    $content_type = "application/pdf";
                                    break;
                                case ".pgp":
                                    $content_type = "application/pgp";
                                    break;
                                case ".ps":
                                case ".eps":
                                case ".ai":
                                    $content_type = "application/postscript";
                                    break;
                                case ".ppt":
                                    $content_type = "application/powerpoint";
                                    break;
                                case ".rtf":
                                    $content_type = "application/rtf";
                                    break;
                                case ".tgz":
                                case ".gtar":
                                    $content_type = "application/x-gtar";
                                    break;
                                case ".gz":
                                    $content_type = "application/x-gzip";
                                    break;
                                case ".php":
                                case ".php3":
                                    $content_type = "application/x-httpd-php";
                                    break;
                                case ".js":
                                    $content_type = "application/x-javascript";
                                    break;
                                case ".ppd":
                                case ".psd":
                                    $content_type = "application/x-photoshop";
                                    break;
                                case ".swf":
                                case ".swc":
                                case ".rf":
                                    $content_type = "application/x-shockwave-flash";
                                    break;
                                case ".tar":
                                    $content_type = "application/x-tar";
                                    break;
                                case ".zip":
                                    $content_type = "application/zip";
                                    break;
                                case ".mid":
                                case ".midi":
                                case ".kar":
                                    $content_type = "audio/midi";
                                    break;
                                case ".mp2":
                                case ".mp3":
                                case ".mpga":
                                    $content_type = "audio/mpeg";
                                    break;
                                case ".ra":
                                    $content_type = "audio/x-realaudio";
                                    break;
                                case ".wav":
                                    $content_type = "audio/wav";
                                    break;
                                case ".bmp":
                                    $content_type = "image/bitmap";
                                    break;
                                case ".gif":
                                    $content_type = "image/gif";
                                    break;
                                case ".iff":
                                    $content_type = "image/iff";
                                    break;
                                case ".jb2":
                                    $content_type = "image/jb2";
                                    break;
                                case ".jpg":
                                case ".jpe":
                                case ".jpeg":
                                    $content_type = "image/jpeg";
                                    break;
                                case ".jpx":
                                    $content_type = "image/jpx";
                                    break;
                                case ".png":
                                    $content_type = "image/png";
                                    break;
                                case ".tif":
                                case ".tiff":
                                    $content_type = "image/tiff";
                                    break;
                                case ".wbmp":
                                    $content_type = "image/vnd.wap.wbmp";
                                    break;
                                case ".xbm":
                                    $content_type = "image/xbm";
                                    break;
                                case ".css":
                                    $content_type = "text/css";
                                    break;
                                case ".txt":
                                    $content_type = "text/plain";
                                    break;
                                case ".htm":
                                case ".html":
                                    $content_type = "text/html";
                                    break;
                                case ".xml":
                                    $content_type = "text/xml";
                                    break;
                                case ".mpg":
                                case ".mpe":
                                case ".mpeg":
                                    $content_type = "video/mpeg";
                                    break;
                                case ".qt":
                                case ".mov":
                                    $content_type = "video/quicktime";
                                    break;
                                case ".avi":
                                    $content_type = "video/x-ms-video";
                                    break;
                                case ".eml":
                                    $content_type = "message/rfc822";
                                    break;
                                default:
                                    $content_type = "application/octet-stream";
                                    break;
                            }
                            break;
                        default:
                            return($content_type . " is not a supported automatic content type detection method");
                    }
                    break;
                default:
                    return($content_type . " is not a supported file content type");
            }
        }
        else
            $content_type = "application/octet-stream";
        $definition = array(
            "Content-Type" => $content_type,
            "NAME" => $name
        );
        if (isset($file["FileName"])) {
            if (GetType($length = @filesize($file["FileName"])) != "integer") {
                $error = "it was not possible to determine the length of the file " . $file["FileName"];
                if (isset($php_errormsg) && strlen($php_errormsg))
                    $error.=": " . $php_errormsg;
                if (!file_exists($file["FileName"]))
                    $error = "it was not possible to access the file " . $file["FileName"];
                return($error);
            }
            $definition["FILENAME"] = $file["FileName"];
            $definition["Content-Length"] = $length;
        }
        elseif (isset($file["Data"]))
            $definition["Content-Length"] = strlen($definition["DATA"] = $file["Data"]);
        else
            return("it was not specified a valid file name");
        return("");
    }

    public function connectFromProxy ($arguments, &$headers) {
        if (!$this->putLine('CONNECT ' . $this->host_name . ':' . ($this->host_port ? $this->host_port : 443) . ' HTTP/1.0') || (strlen($this->user_agent) && !$this->putLine('User-Agent: ' . $this->user_agent)) || (strlen($this->accept) && !$this->putLine('Accept: ' . $this->accept)) || (isset($arguments['Headers']['Proxy-Authorization']) && !$this->putLine('Proxy-Authorization: ' . $arguments['Headers']['Proxy-Authorization'])) || !$this->putLine('')) {
            $this->disconnect();
            return($this->error);
        }
        $this->state = "connectSent";
        if (strlen($error = $this->readReplyHeadersResponse($headers)))
            return($error);
        $proxy_authorization = "";
        while (!strcmp($this->response_status, "100")) {
            $this->state = "connectSent";
            if (strlen($error = $this->readReplyHeadersResponse($headers)))
                return($error);
        }
        switch ($this->response_status) {
            case "200":
                if (!@stream_socket_enable_crypto($this->connection, 1, STREAM_CRYPTO_METHOD_SSLv23_CLIENT)) {
                    $this->setPHPError('it was not possible to start a SSL encrypted connection via this proxy', $php_errormsg, self::HTTP_CLIENT_ERROR_COMMUNICATION_FAILURE);
                    $this->disconnect();
                    return($this->error);
                }
                $this->state = "connected";
                break;
            case "407":
                if (strlen($error = $this->authenticate($headers, -1, $proxy_authorization, $this->proxy_request_user, $this->proxy_request_password, $this->proxy_request_realm, $this->proxy_request_workstation)))
                    return($error);
                break;
            default:
                return($this->setError("unable to send request via proxy", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
        }
        return("");
    }

    public function sendRequest ($arguments) {
        if (strlen($this->error))
            return($this->error);
        if (isset($arguments["ProxyUser"]))
            $this->proxy_request_user = $arguments["ProxyUser"];
        elseif (isset($this->proxy_user))
            $this->proxy_request_user = $this->proxy_user;
        if (isset($arguments["ProxyPassword"]))
            $this->proxy_request_password = $arguments["ProxyPassword"];
        elseif (isset($this->proxy_password))
            $this->proxy_request_password = $this->proxy_password;
        if (isset($arguments["ProxyRealm"]))
            $this->proxy_request_realm = $arguments["ProxyRealm"];
        elseif (isset($this->proxy_realm))
            $this->proxy_request_realm = $this->proxy_realm;
        if (isset($arguments["ProxyWorkstation"]))
            $this->proxy_request_workstation = $arguments["ProxyWorkstation"];
        elseif (isset($this->proxy_workstation))
            $this->proxy_request_workstation = $this->proxy_workstation;
        switch ($this->state) {
            case "disconnected":
                return($this->setError("connection was not yet established", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connected":
                $connect = 0;
                break;
            case "connectedToProxy":
                if (strlen($error = $this->connectFromProxy($arguments, $headers)))
                    return($error);
                $connect = 1;
                break;
            default:
                return($this->setError("can not send request in the current connection state", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        }
        if (isset($arguments["RequestMethod"]))
            $this->request_method = $arguments["RequestMethod"];
        if (isset($arguments["User-Agent"]))
            $this->user_agent = $arguments["User-Agent"];
        if (!isset($arguments["Headers"]["User-Agent"]) && strlen($this->user_agent))
            $arguments["Headers"]["User-Agent"] = $this->user_agent;
        if (isset($arguments["KeepAlive"]))
            $this->keep_alive = intval($arguments["KeepAlive"]);
        if (!isset($arguments["Headers"]["connection"]) && $this->keep_alive)
            $arguments["Headers"]["connection"] = 'Keep-Alive';
        if (isset($arguments["Accept"]))
            $this->user_agent = $arguments["Accept"];
        if (!isset($arguments["Headers"]["Accept"]) && strlen($this->accept))
            $arguments["Headers"]["Accept"] = $this->accept;
        if (strlen($this->request_method) == 0)
            return($this->setError("it was not specified a valid request method", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        if (isset($arguments["RequestURI"]))
            $this->request_uri = $arguments["RequestURI"];
        if (strlen($this->request_uri) == 0 || substr($this->request_uri, 0, 1) != "/")
            return($this->setError("it was not specified a valid request URI", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        $this->request_arguments = $arguments;
        $this->request_headers = (isset($arguments["Headers"]) ? $arguments["Headers"] : array());
        $body_length = 0;
        $this->request_body = "";
        $get_body = 1;
        if ($this->request_method == "POST" || $this->request_method == "PUT") {
            if (isset($arguments['StreamRequest'])) {
                $get_body = 0;
                $this->request_headers["Transfer-Encoding"] = "chunked";
            } elseif (isset($arguments["PostFiles"]) || ($this->force_multipart_form_post && isset($arguments["PostValues"]))) {
                $boundary = "--" . md5(uniqid(time()));
                $this->request_headers["Content-Type"] = "multipart/form-data; boundary=" . $boundary . (isset($arguments["CharSet"]) ? "; charset=" . $arguments["CharSet"] : "");
                $post_parts = array();
                if (isset($arguments["PostValues"])) {
                    $values = $arguments["PostValues"];
                    if (GetType($values) != "array")
                        return($this->setError("it was not specified a valid POST method values array", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                    for (Reset($values), $value = 0; $value < count($values); Next($values), $value++) {
                        $input = Key($values);
                        $headers = "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $input . "\"\r\n\r\n";
                        $data = $values[$input];
                        $post_parts[] = array("HEADERS" => $headers, "DATA" => $data);
                        $body_length+=strlen($headers) + strlen($data) + strlen("\r\n");
                    }
                }
                $body_length+=strlen("--" . $boundary . "--\r\n");
                $files = (isset($arguments["PostFiles"]) ? $arguments["PostFiles"] : array());
                Reset($files);
                $end = (GetType($input = Key($files)) != "string");
                for (; !$end;) {
                    if (strlen($error = $this->getFileDefinition($files[$input], $definition)))
                        return("3 " . $error);
                    $headers = "--" . $boundary . "\r\nContent-Disposition: form-data; name=\"" . $input . "\"; filename=\"" . $definition["NAME"] . "\"\r\nContent-Type: " . $definition["Content-Type"] . "\r\n\r\n";
                    $part = count($post_parts);
                    $post_parts[$part] = array("HEADERS" => $headers);
                    if (isset($definition["FILENAME"])) {
                        $post_parts[$part]["FILENAME"] = $definition["FILENAME"];
                        $data = "";
                    }
                    else
                        $data = $definition["DATA"];
                    $post_parts[$part]["DATA"] = $data;
                    $body_length+=strlen($headers) + $definition["Content-Length"] + strlen("\r\n");
                    Next($files);
                    $end = (GetType($input = Key($files)) != "string");
                }
                $get_body = 0;
            }
            elseif (isset($arguments["PostValues"])) {
                $values = $arguments["PostValues"];
                if (GetType($values) != "array")
                    return($this->setError("it was not specified a valid POST method values array", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                for (Reset($values), $value = 0; $value < count($values); Next($values), $value++) {
                    $k = Key($values);
                    if (GetType($values[$k]) == "array") {
                        for ($v = 0; $v < count($values[$k]); $v++) {
                            if ($value + $v > 0)
                                $this->request_body.="&";
                            $this->request_body.=UrlEncode($k) . "=" . UrlEncode($values[$k][$v]);
                        }
                    }
                    else {
                        if ($value > 0)
                            $this->request_body.="&";
                        $this->request_body.=UrlEncode($k) . "=" . UrlEncode($values[$k]);
                    }
                }
                $this->request_headers["Content-Type"] = "application/x-www-form-urlencoded" . (isset($arguments["CharSet"]) ? "; charset=" . $arguments["CharSet"] : "");
                $get_body = 0;
            }
        }
        if ($get_body && (isset($arguments["Body"]) || isset($arguments["BodyStream"]))) {
            if (isset($arguments["Body"]))
                $this->request_body = $arguments["Body"];
            else {
                $stream = $arguments["BodyStream"];
                $this->request_body = "";
                for ($part = 0; $part < count($stream); $part++) {
                    if (isset($stream[$part]["Data"]))
                        $this->request_body.=$stream[$part]["Data"];
                    elseif (isset($stream[$part]["File"])) {
                        if (!($file = @fopen($stream[$part]["File"], "rb")))
                            return($this->setPHPError("could not open upload file " . $stream[$part]["File"], $php_errormsg, self::HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE));
                        while (!feof($file)) {
                            if (GetType($block = @fread($file, $this->file_buffer_length)) != "string") {
                                $error = $this->setPHPError("could not read body stream file " . $stream[$part]["File"], $php_errormsg, self::HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE);
                                fclose($file);
                                return($error);
                            }
                            $this->request_body.=$block;
                        }
                        fclose($file);
                    }
                    else
                        return("5 it was not specified a valid file or data body stream element at position " . $part);
                }
            }
            if (!isset($this->request_headers["Content-Type"]))
                $this->request_headers["Content-Type"] = "application/octet-stream" . (isset($arguments["CharSet"]) ? "; charset=" . $arguments["CharSet"] : "");
        }
        if (isset($arguments["AuthUser"]))
            $this->request_user = $arguments["AuthUser"];
        elseif (isset($this->user))
            $this->request_user = $this->user;
        if (isset($arguments["AuthPassword"]))
            $this->request_password = $arguments["AuthPassword"];
        elseif (isset($this->password))
            $this->request_password = $this->password;
        if (isset($arguments["AuthRealm"]))
            $this->request_realm = $arguments["AuthRealm"];
        elseif (isset($this->realm))
            $this->request_realm = $this->realm;
        if (isset($arguments["AuthWorkstation"]))
            $this->request_workstation = $arguments["AuthWorkstation"];
        elseif (isset($this->workstation))
            $this->request_workstation = $this->workstation;
        if (strlen($this->proxy_host_name) == 0 || $connect)
            $request_uri = $this->request_uri;
        else {
            switch (strtolower($this->protocol)) {
                case "http":
                    $default_port = 80;
                    break;
                case "https":
                    $default_port = 443;
                    break;
            }
            $request_uri = strtolower($this->protocol) . "://" . $this->host_name . (($this->host_port == 0 || $this->host_port == $default_port) ? "" : ":" . $this->host_port) . $this->request_uri;
        }
        if ($this->use_curl) {
            $version = (GetType($v = curl_version()) == "array" ? (isset($v["version"]) ? $v["version"] : "0.0.0") : (preg_match("/^libcurl\\/([0-9]+\\.[0-9]+\\.[0-9]+)/", $v, $m) ? $m[1] : "0.0.0"));
            $curl_version = 100000 * intval($this->Tokenize($version, ".")) + 1000 * intval($this->Tokenize(".")) + intval($this->Tokenize(""));
            $protocol_version = ($curl_version < 713002 ? "1.0" : $this->protocol_version);
        }
        else
            $protocol_version = $this->protocol_version;
        $this->request = $this->request_method . " " . $request_uri . " HTTP/" . $protocol_version;
        if ($body_length || ($body_length = strlen($this->request_body)) || !strcmp($this->request_method, 'POST'))
            $this->request_headers["Content-Length"] = $body_length;
        for ($headers = array(), $host_set = 0, Reset($this->request_headers), $header = 0; $header < count($this->request_headers); Next($this->request_headers), $header++) {
            $header_name = Key($this->request_headers);
            $header_value = $this->request_headers[$header_name];
            if (GetType($header_value) == "array") {
                for (Reset($header_value), $value = 0; $value < count($header_value); Next($header_value), $value++)
                    $headers[] = $header_name . ": " . $header_value[Key($header_value)];
            }
            else
                $headers[] = $header_name . ": " . $header_value;
            if (strtolower(Key($this->request_headers)) == "host") {
                $this->request_host = strtolower($header_value);
                $host_set = 1;
            }
        }
        if (!$host_set) {
            $headers[] = "Host: " . $this->host_name;
            $this->request_host = strtolower($this->host_name);
        }
        if (count($this->cookies)) {
            $cookies = array();
            $this->pickCookies($cookies, 0);
            if (strtolower($this->protocol) == "https")
                $this->pickCookies($cookies, 1);
            if (count($cookies)) {
                $h = count($headers);
                $headers[$h] = "Cookie:";
                for (Reset($cookies), $cookie = 0; $cookie < count($cookies); Next($cookies), $cookie++) {
                    $cookie_name = Key($cookies);
                    $headers[$h].=" " . $cookie_name . "=" . $cookies[$cookie_name]["value"] . ";";
                }
            }
        }
        $next_state = "RequestSent";
        if ($this->use_curl) {
            if (isset($arguments['StreamRequest']))
                return($this->setError("Streaming request data is not supported when using Curl", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            if ($body_length && strlen($this->request_body) == 0) {
                for ($request_body = "", $success = 1, $part = 0; $part < count($post_parts); $part++) {
                    $request_body.=$post_parts[$part]["HEADERS"] . $post_parts[$part]["DATA"];
                    if (isset($post_parts[$part]["FILENAME"])) {
                        if (!($file = @fopen($post_parts[$part]["FILENAME"], "rb"))) {
                            $this->setPHPError("could not open upload file " . $post_parts[$part]["FILENAME"], $php_errormsg, self::HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE);
                            $success = 0;
                            break;
                        }
                        while (!feof($file)) {
                            if (GetType($block = @fread($file, $this->file_buffer_length)) != "string") {
                                $this->setPHPError("could not read upload file", $php_errormsg, HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE);
                                $success = 0;
                                break;
                            }
                            $request_body.=$block;
                        }
                        fclose($file);
                        if (!$success)
                            break;
                    }
                    $request_body.="\r\n";
                }
                $request_body.="--" . $boundary . "--\r\n";
            }
            else
                $request_body = $this->request_body;
            curl_setopt($this->connection, CURLOPT_HEADER, 1);
            curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, 1);
            if ($this->timeout)
                curl_setopt($this->connection, CURLOPT_TIMEOUT, $this->timeout);
            curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($this->connection, CURLOPT_SSL_VERIFYHOST, 0);
            $request = $this->request . "\r\n" . implode("\r\n", $headers) . "\r\n\r\n" . $request_body;
            curl_setopt($this->connection, CURLOPT_CUSTOMREQUEST, $request);
            if ($this->debug)
                $this->outputDebug("C " . $request);
            if (!($success = (strlen($this->response = curl_exec($this->connection)) != 0))) {
                $error = curl_error($this->connection);
                $this->setError("Could not execute the request" . (strlen($error) ? ": " . $error : ""), self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE);
            }
        } else {
            if (($success = $this->putLine($this->request))) {
                for ($header = 0; $header < count($headers); $header++) {
                    if (!$success = $this->putLine($headers[$header]))
                        break;
                }
                if ($success && ($success = $this->putLine(""))) {
                    if (isset($arguments['StreamRequest']))
                        $next_state = "SendingRequestBody";
                    elseif ($body_length) {
                        if (strlen($this->request_body))
                            $success = $this->putData($this->request_body);
                        else {
                            for ($part = 0; $part < count($post_parts); $part++) {
                                if (!($success = $this->putData($post_parts[$part]["HEADERS"])) || !($success = $this->putData($post_parts[$part]["DATA"])))
                                    break;
                                if (isset($post_parts[$part]["FILENAME"])) {
                                    if (!($file = @fopen($post_parts[$part]["FILENAME"], "rb"))) {
                                        $this->setPHPError("could not open upload file " . $post_parts[$part]["FILENAME"], $php_errormsg, self::HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE);
                                        $success = 0;
                                        break;
                                    }
                                    while (!feof($file)) {
                                        if (GetType($block = @fread($file, $this->file_buffer_length)) != "string") {
                                            $this->setPHPError("could not read upload file", $php_errormsg, self::HTTP_CLIENT_ERROR_CANNOT_ACCESS_LOCAL_FILE);
                                            $success = 0;
                                            break;
                                        }
                                        if (!($success = $this->putData($block)))
                                            break;
                                    }
                                    fclose($file);
                                    if (!$success)
                                        break;
                                }
                                if (!($success = $this->putLine("")))
                                    break;
                            }
                            if ($success)
                                $success = $this->putLine("--" . $boundary . "--");
                        }
                        if ($success)
                            $sucess = $this->flushData();
                    }
                }
            }
        }
        if (!$success)
            return($this->setError("could not send the HTTP request: " . $this->error, $this->error_code));
        $this->state = $next_state;
        return("");
    }

    public function setCookie ($name, $value, $expires = "", $path = "/", $domain = "", $secure = 0, $verbatim = 0) {
        if (strlen($this->error))
            return($this->error);
        if (strlen($name) == 0)
            return($this->setError("it was not specified a valid cookie name", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        if (strlen($path) == 0 || strcmp($path[0], "/"))
            return($this->setError($path . " is not a valid path for setting cookie " . $name, self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        if ($domain == "" || !strpos($domain, ".", $domain[0] == "." ? 1 : 0))
            return($this->setError($domain . " is not a valid domain for setting cookie " . $name, self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        $domain = strtolower($domain);
        if (!strcmp($domain[0], "."))
            $domain = substr($domain, 1);
        if (!$verbatim) {
            $name = $this->cookieEncode($name, 1);
            $value = $this->cookieEncode($value, 0);
        }
        $secure = intval($secure);
        $this->cookies[$secure][$domain][$path][$name] = array(
            "name" => $name,
            "value" => $value,
            "domain" => $domain,
            "path" => $path,
            "expires" => $expires,
            "secure" => $secure
        );
        return("");
    }

    public function sendRequestBody ($data, $end_of_data) {
        if (strlen($this->error))
            return($this->error);
        switch ($this->state) {
            case "disconnected":
                return($this->setError("connection was not yet established", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connected":
            case "connectedToProxy":
                return($this->setError("request was not sent", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "SendingRequestBody":
                break;
            case "RequestSent":
                return($this->setError("request body was already sent", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            default:
                return($this->setError("can not send the request body in the current connection state", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        }
        $length = strlen($data);
        if ($length) {
            $size = dechex($length) . "\r\n";
            if (!$this->putData($size) || !$this->putData($data))
                return($this->error);
        }
        if ($end_of_data) {
            $size = "0\r\n";
            if (!$this->putData($size))
                return($this->error);
            $this->state = "RequestSent";
        }
        return("");
    }

    public function readReplyHeadersResponse (&$headers) {
        $headers = array();
        if (strlen($this->error))
            return($this->error);
        switch ($this->state) {
            case "disconnected":
                return($this->setError("connection was not yet established", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connected":
                return($this->setError("request was not sent", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connectedToProxy":
                return($this->setError("connection from the remote server from the proxy was not yet established", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "SendingRequestBody":
                return($this->setError("request body data was not completely sent", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connectSent":
                $connect = 1;
                break;
            case "RequestSent":
                $connect = 0;
                break;
            default:
                return($this->setError("can not get request headers in the current connection state", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        }
        $this->content_length = $this->read_length = $this->read_response = $this->remaining_chunk = 0;
        $this->content_length_set = $this->chunked = $this->last_chunk_read = $chunked = 0;
        $this->force_close = $this->connection_close = 0;
        for ($this->response_status = "";;) {
            $line = $this->getLine();
            if (GetType($line) != "string")
                return($this->setError("could not read request reply: " . $this->error, $this->error_code));
            if (strlen($this->response_status) == 0) {
                if (!preg_match($match = "/^http\\/[0-9]+\\.[0-9]+[ \t]+([0-9]+)[ \t]*(.*)\$/i", $line, $matches))
                    return($this->setError("it was received an unexpected HTTP response status", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                $this->response_status = $matches[1];
                $this->response_message = $matches[2];
            }
            if ($line == "") {
                if (strlen($this->response_status) == 0)
                    return($this->setError("it was not received HTTP response status", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                $this->state = ($connect ? "GotconnectHeaders" : "GotReplyHeaders");
                break;
            }
            $header_name = strtolower($this->Tokenize($line, ":"));
            $header_value = Trim(Chop($this->Tokenize("\r\n")));
            if (isset($headers[$header_name])) {
                if (GetType($headers[$header_name]) == "string")
                    $headers[$header_name] = array($headers[$header_name]);
                $headers[$header_name][] = $header_value;
            }
            else
                $headers[$header_name] = $header_value;
            if (!$connect) {
                switch ($header_name) {
                    case "content-length":
                        $this->content_length = intval($headers[$header_name]);
                        $this->content_length_set = 1;
                        break;
                    case "transfer-encoding":
                        $encoding = $this->Tokenize($header_value, "; \t");
                        if (!$this->use_curl && !strcmp($encoding, "chunked"))
                            $chunked = 1;
                        break;
                    case "set-cookie":
                        if ($this->support_cookies) {
                            if (GetType($headers[$header_name]) == "array")
                                $cookie_headers = $headers[$header_name];
                            else
                                $cookie_headers = array($headers[$header_name]);
                            for ($cookie = 0; $cookie < count($cookie_headers); $cookie++) {
                                $cookie_name = trim($this->Tokenize($cookie_headers[$cookie], "="));
                                $cookie_value = $this->Tokenize(";");
                                $domain = $this->request_host;
                                $path = "/";
                                $expires = "";
                                $secure = 0;
                                while (($name = strtolower(trim(UrlDecode($this->Tokenize("="))))) != "") {
                                    $value = UrlDecode($this->Tokenize(";"));
                                    switch ($name) {
                                        case "domain":
                                            $domain = $value;
                                            break;
                                        case "path":
                                            $path = $value;
                                            break;
                                        case "expires":
                                            if (preg_match("/^((Mon|Monday|Tue|Tuesday|Wed|Wednesday|Thu|Thursday|Fri|Friday|Sat|Saturday|Sun|Sunday), )?([0-9]{2})\\-(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\\-([0-9]{2,4}) ([0-9]{2})\\:([0-9]{2})\\:([0-9]{2}) GMT\$/", $value, $matches)) {
                                                $year = intval($matches[5]);
                                                if ($year < 1900)
                                                    $year+=($year < 70 ? 2000 : 1900);
                                                $expires = "$year-" . $this->months[$matches[4]] . "-" . $matches[3] . " " . $matches[6] . ":" . $matches[7] . ":" . $matches[8];
                                            }
                                            break;
                                        case "secure":
                                            $secure = 1;
                                            break;
                                    }
                                }
                                if (strlen($this->setCookie($cookie_name, $cookie_value, $expires, $path, $domain, $secure, 1)))
                                    $this->error = "";
                            }
                        }
                        break;
                    case "connection":
                        $this->force_close = $this->connection_close = !strcmp(strtolower($header_value), "close");
                        break;
                }
            }
        }
        $this->chunked = $chunked;
        if ($this->content_length_set)
            $this->connection_close = 0;
        return("");
    }

    public function redirect (&$headers) {
        if ($this->follow_redirect) {
            if (!isset($headers["location"]) || (GetType($headers["location"]) != "array" && strlen($location = $headers["location"]) == 0) || (GetType($headers["location"]) == "array" && strlen($location = $headers["location"][0]) == 0))
                return($this->setError("it was received a redirect without location URL", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
            if (strcmp($location[0], "/")) {
                if (!($location_arguments = @parse_url($location)))
                    return($this->setError("the server did not return a valid redirection location URL", self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                if (!isset($location_arguments["scheme"]))
                    $location = ((GetType($end = strrpos($this->request_uri, "/")) == "integer" && $end > 1) ? substr($this->request_uri, 0, $end) : "") . "/" . $location;
            }
            if (!strcmp($location[0], "/"))
                $location = $this->protocol . "://" . $this->host_name . ($this->host_port ? ":" . $this->host_port : "") . $location;
            $error = $this->getRequestArguments($location, $arguments);
            if (strlen($error))
                return($this->setError("could not process redirect url: " . $error, self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
            $arguments["RequestMethod"] = "GET";
            if (strlen($error = $this->close()) == 0 && strlen($error = $this->open($arguments)) == 0 && strlen($error = $this->sendRequest($arguments)) == 0) {
                $this->redirection_level++;
                if ($this->redirection_level > $this->redirection_limit) {
                    $error = "it was exceeded the limit of request redirections";
                    $this->error_code = self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE;
                }
                else
                    $error = $this->readReplyHeaders($headers);
                $this->redirection_level--;
            }
            if (strlen($error))
                return($this->setError($error, $this->error_code));
        }
        return("");
    }

    public function authenticate (&$headers, $proxy, &$proxy_authorization, &$user, &$password, &$realm, &$workstation) {
        if ($proxy) {
            $authenticate_header = "proxy-authenticate";
            $authorization_header = "Proxy-Authorization";
            $authenticate_status = "407";
            $authentication_mechanism = $this->proxy_authentication_mechanism;
        } else {
            $authenticate_header = "www-authenticate";
            $authorization_header = "Authorization";
            $authenticate_status = "401";
            $authentication_mechanism = $this->authentication_mechanism;
        }
        if (isset($headers[$authenticate_header]) && $this->sasl_authenticate) {
            if (function_exists("class_exists") && !class_exists("sasl_client_class"))
                return($this->setError("the SASL client class needs to be loaded to be able to authenticate" . ($proxy ? " with the proxy server" : "") . " and access this site", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            if (GetType($headers[$authenticate_header]) == "array")
                $authenticate = $headers[$authenticate_header];
            else
                $authenticate = array($headers[$authenticate_header]);
            for ($response = "", $mechanisms = array(), $m = 0; $m < count($authenticate); $m++) {
                $mechanism = $this->Tokenize($authenticate[$m], " ");
                $response = $this->Tokenize("");
                if (strlen($authentication_mechanism)) {
                    if (!strcmp($authentication_mechanism, $mechanism)) {
                        $mechanisms[] = $mechanism;
                        break;
                    }
                }
                else
                    $mechanisms[] = $mechanism;
            }
            $sasl = new sasl_client_class;
            if (isset($user))
                $sasl->SetCredential("user", $user);
            if (isset($password))
                $sasl->SetCredential("password", $password);
            if (isset($realm))
                $sasl->SetCredential("realm", $realm);
            if (isset($workstation))
                $sasl->SetCredential("workstation", $workstation);
            $sasl->SetCredential("uri", $this->request_uri);
            $sasl->SetCredential("method", $this->request_method);
            $sasl->SetCredential("session", $this->session);
            do {
                $status = $sasl->Start($mechanisms, $message, $interactions);
            } while ($status == SASL_INTERACT);
            switch ($status) {
                case SASL_CONTINUE:
                    break;
                case SASL_NOMECH:
                    return($this->setError(($proxy ? "proxy " : "") . "authentication error: " . (strlen($authentication_mechanism) ? "authentication mechanism " . $authentication_mechanism . " may not be used: " : "") . $sasl->error, self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                default:
                    return($this->setError("Could not start the SASL " . ($proxy ? "proxy " : "") . "authentication client: " . $sasl->error, self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            }
            if ($proxy >= 0) {
                for (;;) {
                    if (strlen($error = $this->readReplyBody($body, $this->file_buffer_length)))
                        return($error);
                    if (strlen($body) == 0)
                        break;
                }
            }
            $authorization_value = $sasl->mechanism . (isset($message) ? " " . ($sasl->encode_response ? base64_encode($message) : $message) : "");
            $request_arguments = $this->request_arguments;
            $arguments = $request_arguments;
            $arguments["Headers"][$authorization_header] = $authorization_value;
            if (!$proxy && strlen($proxy_authorization))
                $arguments["Headers"]["Proxy-Authorization"] = $proxy_authorization;
            if (strlen($error = $this->close()) || strlen($error = $this->open($arguments)))
                return($this->setError($error, $this->error_code));
            $authenticated = 0;
            if (isset($message)) {
                if ($proxy < 0) {
                    if (strlen($error = $this->connectFromProxy($arguments, $headers)))
                        return($this->setError($error, $this->error_code));
                }
                else {
                    if (strlen($error = $this->sendRequest($arguments)) || strlen($error = $this->readReplyHeadersResponse($headers)))
                        return($this->setError($error, $this->error_code));
                }
                if (!isset($headers[$authenticate_header]))
                    $authenticate = array();
                elseif (GetType($headers[$authenticate_header]) == "array")
                    $authenticate = $headers[$authenticate_header];
                else
                    $authenticate = array($headers[$authenticate_header]);
                for ($mechanism = 0; $mechanism < count($authenticate); $mechanism++) {
                    if (!strcmp($this->Tokenize($authenticate[$mechanism], " "), $sasl->mechanism)) {
                        $response = $this->Tokenize("");
                        break;
                    }
                }
                switch ($this->response_status) {
                    case $authenticate_status:
                        break;
                    case "301":
                    case "302":
                    case "303":
                    case "307":
                        if ($proxy >= 0)
                            return($this->redirect($headers));
                    default:
                        if (intval($this->response_status / 100) == 2) {
                            if ($proxy)
                                $proxy_authorization = $authorization_value;
                            $authenticated = 1;
                            break;
                        }
                        if ($proxy && !strcmp($this->response_status, "401")) {
                            $proxy_authorization = $authorization_value;
                            $authenticated = 1;
                            break;
                        }
                        return($this->setError(($proxy ? "proxy " : "") . "authentication error: " . $this->response_status . " " . $this->response_message, self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                }
            }
            for (; !$authenticated;) {
                do {
                    $status = $sasl->Step($response, $message, $interactions);
                } while ($status == SASL_INTERACT);
                switch ($status) {
                    case SASL_CONTINUE:
                        $authorization_value = $sasl->mechanism . (isset($message) ? " " . ($sasl->encode_response ? base64_encode($message) : $message) : "");
                        $arguments = $request_arguments;
                        $arguments["Headers"][$authorization_header] = $authorization_value;
                        if (!$proxy && strlen($proxy_authorization))
                            $arguments["Headers"]["Proxy-Authorization"] = $proxy_authorization;
                        if ($proxy < 0) {
                            if (strlen($error = $this->connectFromProxy($arguments, $headers)))
                                return($this->setError($error, $this->error_code));
                        }
                        else {
                            if (strlen($error = $this->sendRequest($arguments)) || strlen($error = $this->readReplyHeadersResponse($headers)))
                                return($this->setError($error, $this->error_code));
                        }
                        switch ($this->response_status) {
                            case $authenticate_status:
                                if (GetType($headers[$authenticate_header]) == "array")
                                    $authenticate = $headers[$authenticate_header];
                                else
                                    $authenticate = array($headers[$authenticate_header]);
                                for ($response = "", $mechanism = 0; $mechanism < count($authenticate); $mechanism++) {
                                    if (!strcmp($this->Tokenize($authenticate[$mechanism], " "), $sasl->mechanism)) {
                                        $response = $this->Tokenize("");
                                        break;
                                    }
                                }
                                if ($proxy >= 0) {
                                    for (;;) {
                                        if (strlen($error = $this->readReplyBody($body, $this->file_buffer_length)))
                                            return($error);
                                        if (strlen($body) == 0)
                                            break;
                                    }
                                }
                                $this->state = "connected";
                                break;
                            case "301":
                            case "302":
                            case "303":
                            case "307":
                                if ($proxy >= 0)
                                    return($this->redirect($headers));
                            default:
                                if (intval($this->response_status / 100) == 2) {
                                    if ($proxy)
                                        $proxy_authorization = $authorization_value;
                                    $authenticated = 1;
                                    break;
                                }
                                if ($proxy && !strcmp($this->response_status, "401")) {
                                    $proxy_authorization = $authorization_value;
                                    $authenticated = 1;
                                    break;
                                }
                                return($this->setError(($proxy ? "proxy " : "") . "authentication error: " . $this->response_status . " " . $this->response_message));
                        }
                        break;
                    default:
                        return($this->setError("Could not process the SASL " . ($proxy ? "proxy " : "") . "authentication step: " . $sasl->error, self::HTTP_CLIENT_ERROR_PROTOCOL_FAILURE));
                }
            }
        }
        return("");
    }

    public function readReplyHeaders (&$headers) {
        if (strlen($error = $this->readReplyHeadersResponse($headers)))
            return($error);
        $proxy_authorization = "";
        while (!strcmp($this->response_status, "100")) {
            $this->state = "RequestSent";
            if (strlen($error = $this->readReplyHeadersResponse($headers)))
                return($error);
        }
        switch ($this->response_status) {
            case "301":
            case "302":
            case "303":
            case "307":
                if (strlen($error = $this->redirect($headers)))
                    return($error);
                break;
            case "407":
                if (strlen($error = $this->authenticate($headers, 1, $proxy_authorization, $this->proxy_request_user, $this->proxy_request_password, $this->proxy_request_realm, $this->proxy_request_workstation)))
                    return($error);
                if (strcmp($this->response_status, "401"))
                    return("");
            case "401":
                return($this->authenticate($headers, 0, $proxy_authorization, $this->request_user, $this->request_password, $this->request_realm, $this->request_workstation));
        }
        return("");
    }

    public function readReplyBody (&$body, $length) {
        $body = "";
        if (strlen($this->error))
            return($this->error);
        switch ($this->state) {
            case "disconnected":
                return($this->setError("connection was not yet established", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "connected":
            case "connectedToProxy":
                return($this->setError("request was not sent", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            case "RequestSent":
                if (($error = $this->readReplyHeaders($headers)) != "")
                    return($error);
                break;
            case "GotReplyHeaders":
                break;
            case 'ResponseReceived':
                $body = '';
                return('');
            default:
                return($this->setError("can not get request headers in the current connection state", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
        }
        if ($this->content_length_set)
            $length = min($this->content_length - $this->read_length, $length);
        $body = '';
        if ($length > 0) {
            if (!$this->endOfInput() && ($body = $this->readBytes($length)) == "") {
                if (strlen($this->error))
                    return($this->setError("could not get the request reply body: " . $this->error, $this->error_code));
            }
            $this->read_length+=strlen($body);
            if ($this->endOfInput())
                $this->state = 'ResponseReceived';
        }
        return("");
    }

    public function readWholeReplyBody (&$body) {
        $body = '';
        for (;;) {
            if (strlen($error = $this->readReplyBody($block, $this->file_buffer_length)))
                return($error);
            if (strlen($block) == 0)
                return('');
            $body .= $block;
        }
    }

    public function saveCookies (&$cookies, $domain = '', $secure_only = 0, $persistent_only = 0) {
        $now = gmdate("Y-m-d H-i-s");
        $cookies = array();
        for ($secure_cookies = 0, Reset($this->cookies); $secure_cookies < count($this->cookies); Next($this->cookies), $secure_cookies++) {
            $secure = Key($this->cookies);
            if (!$secure_only || $secure) {
                for ($cookie_domain = 0, Reset($this->cookies[$secure]); $cookie_domain < count($this->cookies[$secure]); Next($this->cookies[$secure]), $cookie_domain++) {
                    $domain_pattern = Key($this->cookies[$secure]);
                    $match = strlen($domain) - strlen($domain_pattern);
                    if (strlen($domain) == 0 || ($match >= 0 && !strcmp($domain_pattern, substr($domain, $match)) && ($match == 0 || $domain_pattern[0] == "." || $domain[$match - 1] == "."))) {
                        for (Reset($this->cookies[$secure][$domain_pattern]), $path_part = 0; $path_part < count($this->cookies[$secure][$domain_pattern]); Next($this->cookies[$secure][$domain_pattern]), $path_part++) {
                            $path = Key($this->cookies[$secure][$domain_pattern]);
                            for (Reset($this->cookies[$secure][$domain_pattern][$path]), $cookie = 0; $cookie < count($this->cookies[$secure][$domain_pattern][$path]); Next($this->cookies[$secure][$domain_pattern][$path]), $cookie++) {
                                $cookie_name = Key($this->cookies[$secure][$domain_pattern][$path]);
                                $expires = $this->cookies[$secure][$domain_pattern][$path][$cookie_name]["expires"];
                                if ((!$persistent_only && strlen($expires) == 0) || (strlen($expires) && strcmp($now, $expires) < 0))
                                    $cookies[$secure][$domain_pattern][$path][$cookie_name] = $this->cookies[$secure][$domain_pattern][$path][$cookie_name];
                            }
                        }
                    }
                }
            }
        }
    }

    public function savePersistentCookies (&$cookies, $domain = '', $secure_only = 0) {
        $this->saveCookies($cookies, $domain, $secure_only, 1);
    }

    public function getPersistentCookies (&$cookies, $domain = '', $secure_only = 0) {
        $this->savePersistentCookies($cookies, $domain, $secure_only);
    }

    public function restoreCookies ($cookies, $clear = 1) {
        $new_cookies = ($clear ? array() : $this->cookies);
        for ($secure_cookies = 0, Reset($cookies); $secure_cookies < count($cookies); Next($cookies), $secure_cookies++) {
            $secure = Key($cookies);
            if (GetType($secure) != "integer")
                return($this->setError("invalid cookie secure value type (" . serialize($secure) . ")", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
            for ($cookie_domain = 0, Reset($cookies[$secure]); $cookie_domain < count($cookies[$secure]); Next($cookies[$secure]), $cookie_domain++) {
                $domain_pattern = Key($cookies[$secure]);
                if (GetType($domain_pattern) != "string")
                    return($this->setError("invalid cookie domain value type (" . serialize($domain_pattern) . ")", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                for (Reset($cookies[$secure][$domain_pattern]), $path_part = 0; $path_part < count($cookies[$secure][$domain_pattern]); Next($cookies[$secure][$domain_pattern]), $path_part++) {
                    $path = Key($cookies[$secure][$domain_pattern]);
                    if (GetType($path) != "string" || strcmp(substr($path, 0, 1), "/"))
                        return($this->setError("invalid cookie path value type (" . serialize($path) . ")", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                    for (Reset($cookies[$secure][$domain_pattern][$path]), $cookie = 0; $cookie < count($cookies[$secure][$domain_pattern][$path]); Next($cookies[$secure][$domain_pattern][$path]), $cookie++) {
                        $cookie_name = Key($cookies[$secure][$domain_pattern][$path]);
                        $expires = $cookies[$secure][$domain_pattern][$path][$cookie_name]["expires"];
                        $value = $cookies[$secure][$domain_pattern][$path][$cookie_name]["value"];
                        if (GetType($expires) != "string" || (strlen($expires) && !preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}\$/", $expires)))
                            return($this->setError("invalid cookie expiry value type (" . serialize($expires) . ")", self::HTTP_CLIENT_ERROR_INVALID_PARAMETERS));
                        $new_cookies[$secure][$domain_pattern][$path][$cookie_name] = array(
                            "name" => $cookie_name,
                            "value" => $value,
                            "domain" => $domain_pattern,
                            "path" => $path,
                            "expires" => $expires,
                            "secure" => $secure
                        );
                    }
                }
            }
        }
        $this->cookies = $new_cookies;
        return("");
    }

}

?>
