<?php

/**
 * GET statuses/mentions_timeline
 * 
 * @desc Returns the 20 most recent mentions (tweets containing a users's @screen_name) 
 * for the authenticating user. The timeline returned is the equivalent of the one seen 
 * when you view your mentions on twitter.com. 
 * This method can only return up to 800 tweets.
 * 
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();
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
 * Specifies the number of tweets to try and retrieve, up to a maximum of 200 per distinct request. The value of count is best thought of as a limit to the number of tweets to return because suspended or deleted content is removed after the count has been applied. We include retweets in the count, even if include_rts is not supplied. It is recommended you always send include_rts=1 when using this API method.
 */
#$params['count'] = true;
/**
 * @param include_entities (optional)
 * The entities node will be disincluded when set to false.
 */
#$params['include_entities'] = false;

/**
 * @param contributor_details (optional)
 * This parameter enhances the contributors element of the status response to include the 
 * screen_name of the contributor. By default only the user_id of the contributor is 
 * included.
 */
#$params['contributor_details'] = true;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/mentions_timeline", $params);
print_r($statuses);
?>