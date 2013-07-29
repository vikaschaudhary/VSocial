<?php

/**
 * GET blocks/list
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
 * @param include_entities optional
 * The entities node will not be included when set to false.
 * @params skip_status optional
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 * 
 * 
 * The URL pattern /version/block/create/:screen_name_or_user_id.format is still 
 * accepted but not recommended. As a sequence of numbers is a valid screen name 
 * we recommend using the screen_name or user_id parameter instead.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "cursor" => '',
    "include_entities" => false,
    "skip_status" => false
);
$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("blocks/list", $params);
print_r($settings);
?>
