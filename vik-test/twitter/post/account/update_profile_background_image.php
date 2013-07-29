<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$params = array(
    /**
     * @optional
     * 
     * The background image for the profile, base64-encoded. 
     * Must be a valid GIF, JPG, or PNG image of less than 800 kilobytes in size. 
     * Images with width larger than 2048 pixels will be forcibly scaled down. 
     * The image must be provided as raw multipart data, not a URL.
     */
    "image" => '',
    /**
     * @optional
     * 
     * Whether or not to tile the background image. If set to true, t or 1 the background 
     * image will be displayed tiled. The image will not be tiled otherwise.
     */
    "tile" => 1,
    /**
     * @optional
     * 
     * The entities node will not be included when set to false.
     */
    "include_entities" => false,
    /**
     * @optional
     * 
     * When set to either true, t or 1 statuses will not be included in 
     * the returned user objects.
     */
    "skip_status" => false,
    /**
     * @optional
     * 
     * Determines whether to display the profile background image or not. 
     * When set to true, t or 1 the background image will be displayed if an image is 
     * being uploaded with the request, or has been uploaded previously. 
     * An error will be returned if you try to use a background image when one is 
     * not being uploaded or does not exist. If this parameter is defined but set 
     * to anything other than true, t or 1, the background image will stop being used.
     */
    "use" => false
);
unset($params['image']);
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/update_profile_background_image", $params);
print_r($settings);
?>
