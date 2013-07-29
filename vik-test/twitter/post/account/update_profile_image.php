<?php

/**
 * POST account/update_profile_image
 * 
 * @desc Updates the authenticating user's profile image. Note that this method expects 
 * raw multipart data, not a URL to an image. This method asynchronously processes the 
 * uploaded file before updating the user's profile image URL. You can either update your 
 * local cache the next time you request the user's information, or, at least 5 seconds 
 * after uploading the image, ask for the updated URL using GET users/show.
 * 
 * @param image required
 * The avatar image for the profile, base64-encoded. Must be a valid GIF, JPG, or PNG 
 * image of less than 700 kilobytes in size. Images with width larger than 500 pixels 
 * will be scaled down. Animated GIFs will be converted to a static GIF of the first 
 * frame, removing the animation.
 * 
 * @param include_entities (optional)
 * The entities node will not be included when set to false.
 * 
 * @param skip_status (optional)
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 * 
 * https://api.twitter.com/1.1/account/update_profile_image.json
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    'image' => '',
    "include_entities" => false,
    "skip_status" => false,
);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/update_profile_image", $params);
print_r($settings);
?>