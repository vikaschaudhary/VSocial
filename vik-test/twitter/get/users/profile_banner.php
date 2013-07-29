<?php

/**
 * GET users/profile_banner
 * 
 * @desc Returns a map of the available size variations of the specified user's profile banner.
 * If the user has not uploaded a profile banner, a HTTP 404 will be served instead. 
 * This method can be used instead of string manipulation on the profile_banner_url returned 
 * in user objects as described in User Profile Images and Banners.
 * 
 * @param user_id  (optional)
 * The ID of the user for whom to return results for. Helpful for disambiguating when a 
 * valid user ID is also a valid screen name.
 * @example 12345
 * @note Specifies the ID of the user to befriend. Helpful for disambiguating when a 
 * valid user ID is also a valid screen name.
 * @param screen_name (optional) * 
 * The screen name of the user for whom to return results for. 
 * Helpful for disambiguating when a valid screen name is also a user ID.
 * @example devk.john
 * 
 * https://api.twitter.com/1.1/users/profile_banner.json?screen_name=twitterapi
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;
$params = array("screen_name" => "Vlkaschaudhary");
$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("users/profile_banner", $params);
print_r($settings);
?>
