<?php

/**
 * POST account/update_profile_banner
 * 
 * @desc Uploads a profile banner on behalf of the authenticating user. 
 * For best results, upload an <5MB image that is exactly 1252px by 626px. 
 * Images will be resized for a number of display options. Users with an uploaded 
 * profile banner will have a profile_banner_url node in their Users objects. 
 * More information about sizing variations can be found in User Profile Images 
 * and Banners and GET users/profile_banner.
 * 
 * Profile banner images are processed asynchronously. The profile_banner_url and its 
 * variant sizes will not necessary be available directly after upload.
 * 
 * @param banner (required)
 * The Base64-encoded or raw image data being uploaded as the user's new profile banner.
 * 
 * @param width (optional)
 * The width of the preferred section of the image being uploaded in pixels. 
 * Use with height, offset_left, and offset_top to select the desired region of the 
 * image to use.
 * 
 * @param height (optional)
 * The height of the preferred section of the image being uploaded in pixels. 
 * Use with width, offset_left, and offset_top to select the desired region of the 
 * image to use.
 * 
 * @param offset_left (optional)
 * The number of pixels by which to offset the uploaded image from the left. 
 * Use with height, width, and offset_top to select the desired region of the
 * image to use.
 * 
 * @param offset_top (optional)
 * The number of pixels by which to offset the uploaded image from the top. 
 * Use with height, width, and offset_left to select the desired region of the 
 * image to use.
 * 
 * https://api.twitter.com/1.1/account/update_profile_banner.json
 * 
 * HTTP Response Codes
 * 200, 201, 202	Profile banner image succesfully uploaded
 * 400	Either an image was not provided or the image data could not be processed
 * 422	The image could not be resized or is too large.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    "banner" => '',
    "width" => 1024,
    "height" => 520,
    "offset_left" => 0,
    "offset_top" => 0,
);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/update_profile_banner", $params);
print_r($settings);
?>