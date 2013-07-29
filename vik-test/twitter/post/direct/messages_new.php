<?php

/**
 * POST direct_messages/destroy
 * @desc Destroys the direct message specified in the required ID parameter. The authenticating 
 * user must be the recipient of the specified direct message.
 * 
 * Important: This method requires an access token with RWD (read, write & direct message) 
 * permissions. Consult The Application Permission Model for more information.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
/**
 * Set Required Parameters
 */
$params = array();
/**
 * @param user_id required
 * The ID of the user who should receive the direct message. Helpful for disambiguating 
 * when a valid user ID is also a valid screen name.
 */
#$params['user_id'] = 12145;
/**
 * @param screen_name required
 * The screen name of the user who should receive the direct message. Helpful for disambiguating when a valid screen name is also a user ID.
 */
$params['screen_name'] = 'devik.john';
/**
 * @param text required
 * 
 * The text of your direct message. Be sure to URL encode as necessary, and keep the message 
 * under 140 characters.
 */
$params['text'] = "Meet me behind the cafeteria after school";
/**
 * Post message
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("direct_messages/new", $params);
print_r($settings);
?>