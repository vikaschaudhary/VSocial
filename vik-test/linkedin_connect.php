<?php

use VSocial\Plugin\LinkedInAuth;

$config = require_once 'config/config.php';
$linkedConfig = $config['linked_in'];
$consumer_key = $linkedConfig['api_key'];
$consumer_secret = $linkedConfig['secret_key'];
$callback_url = $linkedConfig['callback_url'];


$authSession = $_SESSION['linkedin_session'];

if (empty($authSession) || empty($authSession['oauth_token']) || empty($authSession['oauth_token_secret'])) {
    header("Location: http://10.2.2.82/vik-test/public/?service=linkedin");
}

$oauth_verifier = $_REQUEST['oauth_verifier'];

$linkedin = new LinkedInAuth($consumer_key, $consumer_secret, $authSession['oauth_token'], $authSession['oauth_token_secret']);
$access_token = $linkedin->getAccessToken($oauth_verifier);

$_SESSION['linkedin_session'] = $access_token;
header("Location: http://10.2.2.82/vik-test/public/?service=linkedin_options");