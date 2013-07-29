<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    "trend_location_woeid" => 1,
    "sleep_time_enabled" => true, //boolean
    "start_sleep_time" => 15, //13
    "end_sleep_time" => 15, //13             
    "time_zone" => "Asia/Kolkata", //Europe/Copenhagen, Pacific/Tongatapu
    "lang" => "en", //it, en, es
);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/settings", $params);
print_r($settings);
?>
