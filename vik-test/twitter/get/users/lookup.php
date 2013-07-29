<?php

/**
 * GET users/lookup
 * 
 * @desc Returns fully-hydrated user objects for up to 100 users per request, as specified 
 * by comma-separated values passed to the user_id and/or screen_name parameters.
 * This method is especially useful when used in conjunction with collections of user IDs 
 * returned from GET friends/ids and GET followers/ids.
 * GET users/show is used to retrieve a single user object.
 * 
 * @param user_id  (optional)
 * The ID of the user for whom to return results for. Helpful for disambiguating 
 * when a valid user ID is also a valid screen name.
 * @example 12345
 * 
 * @param screen_name (optional) 
 * The screen name of the user for whom to return results for. 
 * Helpful for disambiguating when a valid screen name is also a user ID.
 * @example devk.john
 * 
 * @param include_entities (optional) 
 * The entities node will be disincluded when set to false.
 *
 * https://api.twitter.com/1.1/users/lookup.json
 * 
 *
 * There are a few things to note when using this method.
 * You must be following a protected user to be able to see their most recent status update. 
 * If you don't follow a protected user their status will be removed.
 * The order of user IDs or screen names may not match the order of users in the 
 * returned array.
 * If a requested user is unknown, suspended, or deleted, 
 * then that user will not be returned in the results list.
 * If none of your lookup criteria can be satisfied by returning a user object, 
 * a HTTP 404 will be thrown.
 * You are strongly encouraged to use a POST for larger requests
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "user_id" => "564646461",
    "screen_name" => "Vlkaschaudhary",
    "include_entities" => false
);

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("users/lookup", $params);
print_r($settings);
?>