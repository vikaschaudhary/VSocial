<?php

/**
 * POST statuses/destroy/:id
 * 
 * @desc Destroys the status specified by the required ID parameter. The authenticating user 
 * must be the author of the specified status. Returns the destroyed status if successful.
 * 
 * Use the OAuth tool in this page sidebar to generate the OAuth signature for this request.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';


$params = array();
/**
 * @param id (required)
 * The numerical ID of the desired status.
 */
$params['id'] = 123;
/**
 * @param trim_user (optional)
 * When set to either true, t or 1, each tweet returned in a timeline will include a user 
 * object including only the status authors numerical ID. Omit this parameter to receive
 * the complete user object.
 */
$params['trim_user'] = false;
/**
 * Start twitter api process
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->post("statuses/destroy/:id", $params);
print_r($statuses);
?>
