<?php

/**
 * GET statuses/retweeters/ids
 * 
 * @desc Returns a collection of up to 100 user IDs belonging to users who have retweeted 
 * the tweet specified by the id parameter. This method offers similar data to GET 
 * statuses/retweets/:id and replaces API v1's GET statuses/:id/retweeted_by/ids method.
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
$params['id'] = 327473909412814850;
/**
 * @param  cursor (semi-optional)
 * Causes the list of IDs to be broken into pages of no more than 100 IDs at a time. 
 * The number of IDs returned is not guaranteed to be 100 as suspended users are filtered 
 * out after connections are queried. If no cursor is provided, a value of -1 will be 
 * assumed, which is the first "page." The response from the API will include a 
 * previous_cursor and next_cursor to allow paging back and forth. See Using cursors 
 * to navigate collections for more information. While this method supports the cursor 
 * parameter, the entire result set can be returned in a single cursored collection. 
 * Using the count parameter with this method will not provide segmented cursors for 
 * use with this parameter.
 */
$params['cursor'] = 12893764510938;
/**
 * @param  stringify_ids (optional)
 * Many programming environments will not consume our ids due to their size. Provide this 
 * option to have ids returned as strings instead. Read more about Twitter IDs, JSON 
 * and Snowflake.
 */
$params['stringify_ids'] = true;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/retweeters/ids", $params);
print_r($statuses);
?>