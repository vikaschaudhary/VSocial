<?php

/**
 * GET statuses/user_timeline
 * 
 * @desc Returns a collection of the most recent Tweets posted by the user indicated by 
 * the screen_name or user_id parameters. User timelines belonging to protected users may 
 * only be requested when the authenticated user either "owns" the timeline or is an 
 * approved follower of the owner. The timeline returned is the equivalent of the one 
 * seen when you view a user's profile on twitter.com. This method can only return up to 
 * 3,200 of a user's most recent Tweets. Native retweets of other statuses by the user 
 * is included in this total, regardless of whether include_rts is set to false when 
 * requesting this resource.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();
/**
 * @param user_id (optional)
 * The ID of the user for whom to return results for.
 */
#$params['user_id'] = 1315646;
/**
 * @param screen_name (optional)
 * The screen name of the user for whom to return results for.
 */
$params['screen_name'] = 'Vlkaschaudhary';
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
$params['count'] = true;
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
/**
 * @param include_rts (optional)
 * When set to false, the timeline will strip any native retweets (though they will still count toward both the maximal length of the timeline and the slice selected by the count parameter). Note: If you're using the trim_user parameter in conjunction with include_rts, the retweets will still contain a full user object.
 */
#$params['include_rts'] = false;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/user_timeline", $params);
print_r($statuses);
?>