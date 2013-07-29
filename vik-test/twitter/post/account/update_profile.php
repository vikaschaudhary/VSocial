<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    "name" => 'Vikas',
    "url" => 'http://www.google.com',
    "location" => 'Ahmedabad Gujrat, India',
    "description" => 'Software developer',
    "include_entities" => false, //true/false
    "skip_status" => false, //true/false 
);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/update_profile", $params);
print_r($settings);
?>
