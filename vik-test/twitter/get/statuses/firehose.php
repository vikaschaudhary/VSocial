<?php

/**
 * GET statuses/firehose
 * 
 * @desc This endpoint requires special permission to access. Returns all public statuses. 
 * Few applications require this level of access. Creative use of a combination of 
 * other resources and various access levels can satisfy nearly every application use case.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();

$params['delimited'] = '';
/**
 * @param delimited (optional)
 * Specifies whether messages should be length-delimited. See the delimited parameter documentation for more information.
 */
$params['stall_warnings'] = '245446';

/**
 * @param stall_warnings (optional)
 * 
 * Specifies whether stall warnings should be delivered. See the stall_warnings parameter documentation for more information.
 */
$params['count'] = true;
/**
 * @param count (optional)
 * The number of messages to backfill. See the count parameter documentation for more information.
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/firehose", $params);
print_r($statuses);
?>