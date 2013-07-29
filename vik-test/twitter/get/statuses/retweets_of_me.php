<?php

/**
 * GET statuses/retweets_of_me
 * 
 * @desc Returns the most recent tweets authored by the authenticating user that 
 * have been retweeted by others. This timeline is a subset of the user's GET 
 * statuses/user_timeline.
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();
/**
 * @param id required
 * The numerical ID of the desired Tweet. Example Values: 123
 */
$params['id'] = '245446';

/**
 * @param trim_user (optional)
 * 
 * When set to either true, t or 1, each tweet returned in a timeline will include 
 * a user object including only the status authors numerical ID. Omit this parameter 
 * to receive the complete user object.
 */
#$params['trim_user'] = true;
/**
 * @param since_id (optional)
 * Returns results with an ID greater than (that is, more recent than) the specified ID. 
 * There are limits to the number of Tweets which can be accessed through the API. 
 * If the limit of Tweets has occured since the since_id, the since_id will be forced to 
 * the oldest ID available.
 */
#$params['since_id'] = true;
/**
 * @param count (optional)
 * Specifies the number of records to retrieve. Must be less than or equal to 100. 
 * If omitted, 20 will be assumed.
 */
#$params['max_id'] = true;
/**
 * @param max_id (optional)
 * Returns results with an ID less than (that is, older than) or equal to the specified ID.
 */
#$params['count'] = true;
/**
 * @param include_entities (optional)
 * The entities node will be disincluded when set to false.
 */
#$params['include_entities'] = false;
/**
 * @param include_entities (optional)
 * The user entities node will be disincluded when set to false.
 */
#$params['include_user_entities'] = false;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/retweets_of_me", $params);
print_r($statuses);
?>