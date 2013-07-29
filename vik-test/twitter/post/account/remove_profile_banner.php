<?php

/**
 * POST account/remove_profile_banner
 * 
 * @desc Removes the uploaded profile banner for the authenticating user. 
 * Returns HTTP 200 upon success.
 * 
 * https://api.twitter.com/1.1/account/remove_profile_banner.json
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$params = array();
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("account/remove_profile_banner", $params);
print_r($settings);
?>