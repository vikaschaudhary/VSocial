<?php

/**
 * POST blocks/create
 * 
 * @desc Blocks the specified user from following the authenticating user. In addition 
 * the blocked user will not show in the authenticating users mentions or timeline 
 * (unless retweeted by another user). If a follow or friend relationship exists it 
 * is destroyed.
 * 
 * @param screen_name optional
 * The screen name of the potentially blocked user. Helpful for disambiguating when a 
 * valid screen name is also a user ID.
 * @params user_id optional
 * The ID of the potentially blocked user. Helpful for disambiguating when a valid user 
 * ID is also a valid screen name.
 * @param include_entities optional
 * The entities node will not be included when set to false.
 * @params skip_status optional
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 * 
 * 
 * The URL pattern /version/block/create/:screen_name_or_user_id.format is still 
 * accepted but not recommended. As a sequence of numbers is a valid screen name 
 * we recommend using the screen_name or user_id parameter instead.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "screen_name" => 'Vlkaschaudhry',
    "include_entities" => false,
    "skip_status" => false
);
$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("blocks/create", $params);
print_r($settings);
?>
