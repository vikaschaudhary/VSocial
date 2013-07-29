<?php

/**
 * POST direct_messages/destroy
 * @desc Destroys the direct message specified in the required ID parameter. The authenticating user must be the recipient of the specified direct message.
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
 * @param id required
 * The ID of the direct message to delete.
 */
$params['id'] = 12145;
/**
 * @param include_entities required
 * The entities node will not be included when set to false.
 */
$params['include_entities'] = false;

/**
 * Post message
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("direct_messages/destroy", $params);
print_r($settings);
?>