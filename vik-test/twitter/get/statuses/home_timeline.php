<?php

/**
 * GET statuses/home_timeline
 * 
 * @desc Returns a collection of the most recent Tweets and retweets posted by the 
 * authenticating user and the users they follow. The home timeline is central to 
 * how most users interact with the Twitter service. Up to 800 Tweets are obtainable 
 * on the home timeline. It is more volatile for users that follow many users or follow 
 * users who tweet frequently.
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
 * Returns results with an ID less than (that is, older than) or equal to the specified ID.
 */
#$params['count'] = true;
/**
 * @param include_entities (optional)
 * The entities node will be disincluded when set to false.
 */
#$params['include_entities'] = false;
/**
 * @param exclude_replies (optional)
 * This parameter will prevent replies from appearing in the returned timeline. Using 
 * exclude_replies with the count parameter will mean you will receive up-to count 
 * tweets — this is because the count parameter retrieves that many tweets before 
 * filtering out retweets and replies.
 */
#$params['exclude_replies'] = true;
/**
 * @param contributor_details (optional)
 * This parameter enhances the contributors element of the status response to include the 
 * screen_name of the contributor. By default only the user_id of the contributor is 
 * included.
 */
#$params['contributor_details'] = true;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/home_timeline", $params);
print_r($statuses);
?>