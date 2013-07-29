<?php

/**
 * GET direct_messages
 * 
 * @desc Returns the 20 most recent direct messages sent to the authenticating user. Includes 
 * detailed information about the sender and recipient user. You can request up to 200 direct 
 * messages per call, up to a maximum of 800 incoming DMs. Important: This method requires an 
 * access token with RWD (read, write & direct message) permissions. Consult The Application 
 * Permission Model for more information.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$params = array();
/**
 * @param since_id optional
 * Returns results with an ID greater than (that is, more recent than) the specified ID. 
 * There are limits to the number of Tweets which can be accessed through the API. If the 
 * limit of Tweets has occured since the since_id, the since_id will be forced to 
 * the oldest ID available.
 */
$params['since_id'] = 12145;
/**
 * @param max_id optional
 * Returns results with an ID less than (that is, older than) or equal to the specified ID.
 */
$params['max_id'] = 125445;
/**
 * @param count optional
 * Specifies the number of direct messages to try and retrieve, up to a maximum of 200. The 
 * value of count is best thought of as a limit to the number of Tweets to return because 
 * suspended or deleted content is removed after the count has been applied.
 */
$params['count'] = 10;
/**
 * @param include_entities optional
 * The entities node will not be included when set to false.
 */
$params['include_entities'] = false;
/**
 * @param skip_status optional
 * When set to either true, t or 1 statuses will not be included in the returned user 
 * objects
 */
$params['skip_status'] = 1;


$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("direct_messages", $params);
print_r($settings);
?>
