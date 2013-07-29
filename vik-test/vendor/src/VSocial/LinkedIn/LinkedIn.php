<?php
namespace VSocial\LinkedIn;

/**
 * Linkedin Utilities
 */
use VSocial\LinkedIn\LinkedInException,
    VSocial\LinkedIn\Utils,
    VSocial\LinkedIn\Constants as LinkedIn_Const;
/**
 * OAuth Library
 */
use VSocial\OAuth\Consumer as OAuthConsumer,
    VSocial\OAuth\Token as OAuthToken,
    VSocial\OAuth\Request as OAuthRequest,
    VSocial\OAuth\SignatureMethod\Hmacsha1 as OAuthSignatureMethod_HMAC_SHA1,
    VSocial\OAuth\Exception as OAuthException;

/**
 * LinkedIn Class 
 */
class LinkedIn {

    /**
     * oauth properties
     * @var type 
     */
    protected $callback;
    protected $token = null;

    /**
     * application properties
     * @var type 
     */
    protected $application_key;
    protected $application_secret;
    /*
     * the format of the data to return
     */
    protected $response_format = LinkedIn_Const::_DEFAULT_RESPONSE_FORMAT;

    /**
     * last request fields
     * @var type 
     */
    public $last_request_headers;
    public $last_request_url;

    /**
     * 
     * @param type $config
     * @throws LinkedInException
     */
    public function __construct ($config) {
        if (!is_array($config)) {
            /**
             *  bad data passed
             */
            throw new LinkedInException('LinkedIn->__construct(): bad data passed, $config must be of type array.');
        }
        $this->setApplicationKey($config['appKey']);
        $this->setApplicationSecret($config['appSecret']);
        $this->setCallbackUrl($config['callbackUrl']);
    }

    public function __destruct () {
        unset($this);
    }

    protected function fetch ($method, $url, $data = null, $parameters = array()) {
        try {
            // generate OAuth values
            $oauth_consumer = new OAuthConsumer($this->getApplicationKey(), $this->getApplicationSecret(), $this->getCallbackUrl());
            $oauth_token = $this->getToken();
            $oauth_token = (!is_null($oauth_token)) ? new OAuthToken($oauth_token['oauth_token'], $oauth_token['oauth_token_secret']) : null;
            $defaults = array(
                'oauth_version' => LinkedIn_Const::_API_OAUTH_VERSION
            );
            $parameters = array_merge($defaults, $parameters);

            // generate OAuth request
            $oauth_req = OAuthRequest::from_consumer_and_token($oauth_consumer, $oauth_token, $method, $url, $parameters);
            $oauth_req->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $oauth_consumer, $oauth_token);

            // start cURL, checking for a successful initiation
            if (!$handle = curl_init()) {
                // cURL failed to start
                throw new LinkedInException('LinkedIn->fetch(): cURL did not initialize properly.');
            }

            // set cURL options, based on parameters passed
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($handle, CURLOPT_URL, $url);
            curl_setopt($handle, CURLOPT_VERBOSE, false);

            // configure the header we are sending to LinkedIn - http://developer.linkedin.com/docs/DOC-1203
            $header = array($oauth_req->to_header(LinkedIn_Const::_API_OAUTH_REALM));
            if (is_null($data)) {
                // not sending data, identify the content type
                $header[] = 'Content-Type: text/plain; charset=UTF-8';
                switch ($this->getResponseFormat()) {
                    case LinkedIn_Const::_RESPONSE_JSON:
                        $header[] = 'x-li-format: json';
                        break;
                    case LinkedIn_Const::_RESPONSE_JSONP:
                        $header[] = 'x-li-format: jsonp';
                        break;
                }
            } else {
                $header[] = 'Content-Type: text/xml; charset=UTF-8';
                curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($handle, CURLOPT_HTTPHEADER, $header);

            // set the last url, headers
            $this->last_request_url = $url;
            $this->last_request_headers = $header;

            // gather the response
            $return_data['linkedin'] = curl_exec($handle);
            $return_data['info'] = curl_getinfo($handle);
            $return_data['oauth']['header'] = $oauth_req->to_header(LinkedIn_Const::_API_OAUTH_REALM);
            $return_data['oauth']['string'] = $oauth_req->base_string;

            // check for throttling
            if (Utils::isThrottled($return_data['linkedin'])) {
                throw new LinkedInException('LinkedIn->fetch(): throttling limit for this user/application has been reached for LinkedIn resource - ' . $url);
            }

            //TODO - add check for NO response (http_code = 0) from cURL
            // close cURL connection
            curl_close($handle);

            // no exceptions thrown, return the data
            return $return_data;
        } catch (OAuthException $e) {
            // oauth exception raised
            throw new LinkedInException('OAuth exception caught: ' . $e->getMessage());
        }
    }

    public function getApplicationKey () {
        return $this->application_key;
    }

    public function getApplicationSecret () {
        return $this->application_secret;
    }

    public function getCallbackUrl () {
        return $this->callback;
    }

    public function getResponseFormat () {
        return $this->response_format;
    }

    public function getToken () {
        return $this->token;
    }

    public function getTokenAccess () {
        return $this->getToken();
    }

    public function lastRequestHeader () {
        return $this->last_request_headers;
    }

    public function lastRequestUrl () {
        return $this->last_request_url;
    }

    public function profile ($options = '~') {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->profile(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = LinkedIn_Const::_URL_API . '/v1/people/' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    public function raw ($method, $url, $body = null) {
        if (!is_string($method)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->raw(): bad data passed, $method must be of string value.');
        }
        if (!is_string($url)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->raw(): bad data passed, $url must be of string value.');
        }
        if (!is_null($body) && !is_string($url)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->raw(): bad data passed, $body must be of string value.');
        }

        // construct and send the request
        $query = LinkedIn_Const::_URL_API . '/v1' . trim($url);
        return $this->fetch($method, $query, $body);
    }

    public function retrieveTokenAccess ($token, $secret, $verifier) {
        /**
         * check passed data
         */
        if (!is_string($token) || !is_string($secret) || !is_string($verifier)) {
            /**
             * nothing passed, raise an exception
             */
            throw new LinkedInException('LinkedIn->retrieveTokenAccess(): bad data passed, string type is required for $token, $secret and $verifier.');
        }

        /**
         * start retrieval process
         */
        $this->setToken(array('oauth_token' => $token, 'oauth_token_secret' => $secret));
        $parameters = array(
            'oauth_verifier' => $verifier
        );
        $response = $this->fetch(LinkedIn_Const::_METHOD_TOKENS, LinkedIn_Const::_URL_ACCESS, null, $parameters);
        parse_str($response['linkedin'], $response['linkedin']);

        /**
         * Check for successful request (a 200 response from LinkedIn server) per the documentation linked in method comments above.
         */
        if ($response['info']['http_code'] == 200) {
            // tokens retrieved
            $this->setToken($response['linkedin']);

            /**
             * set the response
             */
            $return_data = $response;
            $return_data['success'] = true;
        } else {
            /**
             * error getting the request tokens
             */
            $this->setToken(null);

            /**
             * set the response
             */
            $return_data = $response;
            $return_data['error'] = 'HTTP response from LinkedIn end-point was not code 200';
            $return_data['success'] = false;
        }
        return $return_data;
    }

    /**
     * 
     * @return boolean
     */
    public function retrieveTokenRequest () {
        $parameters = array(
            'oauth_callback' => $this->getCallbackUrl()
        );
        $response = $this->fetch(LinkedIn_Const::_METHOD_TOKENS, LinkedIn_Const::_URL_REQUEST, null, $parameters);
        parse_str($response['linkedin'], $response['linkedin']);

        /**
         * Check for successful request (a 200 response from LinkedIn server) per the documentation linked in method comments above.
         */
        if (($response['info']['http_code'] == 200) && (array_key_exists('oauth_callback_confirmed', $response['linkedin'])) && ($response['linkedin']['oauth_callback_confirmed'] == 'true')) {
            // tokens retrieved
            $this->setToken($response['linkedin']);

            // set the response
            $return_data = $response;
            $return_data['success'] = true;
        } else {
            // error getting the request tokens
            $this->setToken(null);

            // set the response
            $return_data = $response;
            if ((array_key_exists('oauth_callback_confirmed', $response['linkedin'])) && ($response['linkedin']['oauth_callback_confirmed'] == 'true')) {
                $return_data['error'] = 'HTTP response from LinkedIn end-point was not code 200';
            } else {
                $return_data['error'] = 'OAuth callback URL was not confirmed by the LinkedIn end-point';
            }
            $return_data['success'] = false;
        }
        return $return_data;
    }

    /**
     * 
     * @return type
     */
    public function revoke () {
        // construct and send the request
        $response = $this->fetch('GET', LinkedIn_Const::_URL_REVOKE);

        /**
         * Check for successful request (a 200 response from LinkedIn server) per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * 
     * @param type $key
     */
    public function setApplicationKey ($key) {
        $this->application_key = $key;
    }

    /**
     * 
     * @param type $secret
     */
    public function setApplicationSecret ($secret) {
        $this->application_secret = $secret;
    }

    /**
     * 
     * @param type $url
     */
    public function setCallbackUrl ($url) {
        $this->callback = $url;
    }

    /**
     * 
     * @param type $format
     */
    public function setResponseFormat ($format = LinkedIn_Const::_DEFAULT_RESPONSE_FORMAT) {
        $this->response_format = $format;
    }

    /**
     * 
     * @param type $token
     * @throws LinkedInException
     */
    public function setToken ($token) {
        /**
         *  check passed data
         */
        if (!is_null($token) && !is_array($token)) {
            /**
             * bad data passed
             */
            throw new LinkedInException('LinkedIn->setToken(): bad data passed, $token_access should be in array format.');
        }

        /**
         * set token
         */
        $this->token = $token;
    }

    /**
     * 
     * @param type $token_access
     */
    public function setTokenAccess ($token_access) {
        $this->setToken($token_access);
    }

    /**
     * 
     * @return type
     */
    public function statistics () {
        /**
         * construct and send the request
         */
        $query = LinkedIn_Const::_URL_API . '/v1/people/~/network/network-stats';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Used to check whether a response LinkedIn object has the required http_code or not and 
     * returns an appropriate LinkedIn object.
     * 
     * @param var $http_code
     * 		The required http response from LinkedIn, passed in either as an integer, 
     * 		or an array of integers representing the expected values.	 
     * @param arr $response 
     *    An array containing a LinkedIn response.
     * 
     * @return boolean
     * 	  true or false depending on if the passed LinkedIn response matches the expected response.
     */
    protected function checkResponse ($http_code, $response) {
        /**
         * check passed data
         */
        if (is_array($http_code)) {
            array_walk($http_code, function($value, $key) {
                        if (!is_int($value)) {
                            throw new LinkedInException('LinkedIn->checkResponse(): $http_code must be an integer or an array of integer values');
                        }
                    });
        } else {
            if (!is_int($http_code)) {
                throw new LinkedInException('LinkedIn->checkResponse(): $http_code must be an integer or an array of integer values');
            } else {
                $http_code = array($http_code);
            }
        }
        if (!is_array($response)) {
            throw new LinkedInException('LinkedIn->checkResponse(): $response must be an array');
        }

        // check for a match
        if (in_array($response['info']['http_code'], $http_code)) {
            // response found
            $response['success'] = true;
        } else {
            // response not found
            $response['success'] = false;
            $response['error'] = 'HTTP response from LinkedIn end-point was not code ' . implode(', ', $http_code);
        }
        return $response;
    }

    /**
     * updates
     * 
     * @param type $options
     * @param type $id
     * @return type
     * @throws LinkedInException
     */
    public function updates ($options = null, $id = null) {
        /**
         * check passed data
         */
        if (!is_null($options) && !is_string($options)) {
            /**
             * bad data passed
             */
            throw new LinkedInException('LinkedIn->updates(): bad data passed, $options must be of type string.');
        }
        if (!is_null($id) && !is_string($id)) {
            /**
             * bad data passed
             */
            throw new LinkedInException('LinkedIn->updates(): bad data passed, $id must be of type string.');
        }

        /**
         * construct and send the request
         */
        if (!is_null($id) && LinkedIn_Const::isId($id)) {
            $query = LinkedIn_Const::_URL_API . '/v1/people/' . $id . '/network/updates' . trim($options);
        } else {
            $query = LinkedIn_Const::_URL_API . '/v1/people/~/network/updates' . trim($options);
        }
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

}

?>
