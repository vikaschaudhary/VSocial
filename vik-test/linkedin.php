<?php

use VSocial\Plugin\LinkedInAuth;

$config = require_once 'config/config.php';
$linkedConfig = $config['linked_in'];
$consumer_key = $linkedConfig['api_key'];
$consumer_secret = $linkedConfig['secret_key'];
$callback_url = $linkedConfig['callback_url'];
#$oauth_user_token = $linkedConfig['oauth_user_token'];
#$oauth_user_secret = $linkedConfig['oauth_user_secret'];
#$scope = $linkedConfig['scope'];




$linkedin = new LinkedInAuth($consumer_key, $consumer_secret);
$access_token = $linkedin->getRequestToken($callback_url);

if (isset($_SESSION['linkedin_session'])) {
    unset($_SESSION['linkedin_session']);
}

$_SESSION['linkedin_session'] = $access_token;

/**
 * Redirect 
 */
switch ($linkedin->http_code) {
    case 200:
        /**
         *  Build authorize URL and redirect user to Twitter. 
         */
       echo $url = $linkedin->getAuthorizeURL($access_token['oauth_token']);
        header("Location: {$url}");
        break;
    default:
        break;
}


















//$oauth = new OAuth($api_key, $secret_key);
//$request_token_response = $oauth->getRequestToken('https://api.linkedin.com/uas/oauth/requestToken');
//if ($request_token_response === FALSE) {
//    throw new Exception("Failed fetching request token, response was: " . $oauth->getLastResponse());
//} else {
//    $request_token = $request_token_response;
//}
//
//print "Request Token:\n";
//printf("    - oauth_token        = %s\n", $request_token['oauth_token']);
//printf("    - oauth_token_secret = %s\n", $request_token['oauth_token_secret']);
//print "\n";
//print "Go to the following link in your browser:\n\n";
//printf("https://api.linkedin.com/uas/oauth/authorize?oauth_token=%s", $request_token['oauth_token']);
//print "\n\n";
?>