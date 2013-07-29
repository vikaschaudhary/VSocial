<?php

use VSocial\LinkedIn\LinkedIn;
use VSocial\LinkedIn\Constants as LinkedInConsts;
use VSocial\LinkedIn\LinkedInException;

/**
 * nothing being passed back, display demo page check PHP version
 */
if (version_compare(PHP_VERSION, '5.3.3', '<')) {
    throw new LinkedInException('You must be running version 5.3.3 or greater of PHP to use this library.');
}

/**
 * check for cURL
 */
if (extension_loaded('curl')) {
    $curl_version = curl_version();
    "Curl Version" . $curl_version['version'];
} else {
    throw new LinkedInException('You must load the cURL extension to use this library.');
}
/**
 * Get Config
 */
$config = require_once 'config/config.php';
$linkedConfig = $config['linkedin'];

/**
 * Set Requestr Index
 */
$_REQUEST[LinkedInConsts::_GET_TYPE] = (isset($_REQUEST[LinkedInConsts::_GET_TYPE])) ?
        $_REQUEST[LinkedInConsts::_GET_TYPE] :
        'initiate';
/**
 * Process Requset
 */
switch ($_REQUEST[LinkedInConsts::_GET_TYPE]) {
    /**
     * Handle user initiated LinkedIn connection, create the LinkedIn object.
     */
    case 'initiate':

        /**
         * check for the correct http protocol (i.e. is this script being served via http or https)
         */
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';

        /**
         *  set the callback url
         */
        $linkedConfig['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] .
                ((($_SERVER['SERVER_PORT'] != LinkedInConsts::PORT_HTTP) || ($_SERVER['SERVER_PORT'] != LinkedInConsts::PORT_HTTP_SSL)) ?
                        ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' .
                LinkedInConsts::_GET_TYPE . '=initiate&' . LinkedInConsts::_GET_RESPONSE . '=1';

        $linkedinObj = new LinkedIn($linkedConfig);

        /**
         * check for response from LinkedIn
         */
        $_GET[LinkedInConsts::_GET_RESPONSE] = (isset($_GET[LinkedInConsts::_GET_RESPONSE])) ? $_GET[LinkedInConsts::_GET_RESPONSE] : '';
        if (!$_GET[LinkedInConsts::_GET_RESPONSE]) {
            /**
             * LinkedIn hasn't sent us a response, the user is initiating the connection send a request for a LinkedIn access token
             */
            $response = $linkedinObj->retrieveTokenRequest();
            if ($response['success'] === true) {
                /**
                 *  store the request token
                 */
                $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];

                /**
                 * redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
                 */
                echo LinkedInConsts::_URL_AUTH . $response['linkedin']['oauth_token'];exit;
                header('Location: ' . LinkedInConsts::_URL_AUTH . $response['linkedin']['oauth_token']);
            } else {
                /**
                 *  bad token request
                 */
                echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, true) . "</pre><br /><br />LinkedInConsts OBJ:<br /><br /><pre>" . print_r($linkedinObj, true) . "</pre>";
            }
        } else {
            /**
             *  LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
             */
            $response = $linkedinObj->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
            if ($response['success'] === true) {
                /**
                 * the request went through without an error, gather user's 'access' tokens
                 */
                $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];

                /**
                 * set the user as authorized for future quick reference
                 */
                $_SESSION['oauth']['linkedin']['authorized'] = true;
                print_r($_SESSION);
                print_r($_SERVER);
                exit;
                /**
                 * redirect the user back to the demo page
                 */
                header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
                /**
                 * bad token access
                 */
                echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, true) . "</pre><br /><br />LinkedInConsts OBJ:<br /><br /><pre>" . print_r($linkedinObj, true) . "</pre>";
            }
        }
        break;
    default:

        break;
}
?>
