<?php

/**
 * GET blocks/ids
 * 
 * @desc Returns a collection of user objects that the authenticating user is blocking. 
 * Important On October 15, 2012 this method will become cursored by default, 
 * altering the default response format. See Using cursors to navigate collections 
 * for more details on how cursoring works.
 * 
 * @param cursor semi-optional
 * Causes the list of blocked users to be broken into pages of no more than 
 * 5000 IDs at a time. The number of IDs returned is not guaranteed to be 
 * 5000 as suspended users are filtered out after connections are queried. 
 * If no cursor is provided, a value of -1 will be assumed, which is the first "page."
 * The response from the API will include a previous_cursor and next_cursor to allow 
 * paging back and forth. See Using cursors to navigate collections for more information.
 * Example Values: 12893764510938
 * 
 * @param stringify_ids optional
 * 
 * Many programming environments will not consume our ids due to their size. 
 * Provide this option to have ids returned as strings instead. Read more about 
 * Twitter IDs, JSON and Snowflake.
 *  
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "cursor" => '',
    "stringify_ids" => true
);
$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("blocks/ids", $params);
print_r($settings);
?>
