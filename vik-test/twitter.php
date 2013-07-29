<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
echo "<pre>";
$twitterAuth = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret']);
$request_token = $twitterAuth->getRequestToken($twitterConfig['callback_url']);
if (isset($_SESSION['twitter_session'])) {
    unset($_SESSION['twitter_session']);
}

$_SESSION['twitter_session'] = $request_token;

/**
 * Redirect 
 */
switch ($twitterAuth->http_code) {
    case 200:
        /**
         *  Build authorize URL and redirect user to Twitter. 
         */
        $url = $twitterAuth->getAuthorizeURL($request_token['oauth_token']);
        header("Location: {$url}");
        break;
    default:
        break;
}
?>
