<?php

/**
 * POST account/update_profile_colors
 * 
 * @desc Sets one or more hex values that control the color scheme of the authenticating 
 * user's profile page on twitter.com. Each parameter's value must be a valid hexidecimal 
 * value, and may be either three or six characters (ex: #fff or #ffffff).
 * 
 * @param profile_background_color (required)
 * Profile background color. Example 3D3D3D
 * 
 * @param profile_link_color (optional)
 * Profile link color. Example Values: 0000FF
 * 
 * @param profile_sidebar_border_color (required)
 * Profile sidebar's border color. Example 0F0F0F
 * 
 * @param profile_sidebar_fill_color (optional)
 * Profile sidebar's background color. Example Values: 0000FF
 * 
 * @param profile_text_color (optional)
 * Profile text color. Example Values: 0000FF
 * 
 * @param include_entities (optional)
 * The entities node will not be included when set to false.
 * 
 * @param skip_status (optional)
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 * 
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    "profile_background_color" => '3D3D3D',
    "profile_link_color" => '0000FF',
    "profile_sidebar_border_color" => '0F0F0F',
    "profile_sidebar_fill_color" => '0000FF',
    "profile_text_color" => '0000FF',
    "include_entities" => false,
    "skip_status" => false,
);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/update_profile_colors", $params);
print_r($settings);
?>