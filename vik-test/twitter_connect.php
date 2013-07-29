<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
$authSession = $_SESSION['twitter_session'];
if (empty($authSession) || empty($authSession['oauth_token']) || empty($authSession['oauth_token_secret'])) {
    header("Location: http://10.2.2.82/vik-test/public/?service=twitter");
}
$oauth_verifier = $_REQUEST['oauth_verifier'];
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$access_token = $twitter->getAccessToken($oauth_verifier);
$_SESSION['twitter_session'] = $access_token;
header("Location: http://10.2.2.82/vik-test/public/?service=twitter_options");
#$content = $twitter->get('account/verify_credentials');
?>
