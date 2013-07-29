<?php

/**
 * GET users/show
 * 
 * @desc Returns a variety of information about the user specified by the required user_id 
 * or screen_name parameter. The author's most recent Tweet will be returned inline when 
 * possible.
 * GET users/lookup is used to retrieve a bulk collection of user objects

 * @param user_id  (required)
 * The ID of the user for whom to return results for. Helpful for disambiguating 
 * when a valid user ID is also a valid screen name.
 * @example 12345
 * 
 * @param screen_name (required) 
 * The screen name of the user for whom to return results for. 
 * Helpful for disambiguating when a valid screen name is also a user ID.
 * @example devk.john
 * 
 * @param include_entities (optional) 
 * The entities node will be disincluded when set to false.
 * 
 * https://api.twitter.com/1.1/users/show.json
 * 
 * You must be following a protected user to be able to see their most recent Tweet. 
 * If you don't follow a protected user, the users Tweet will be removed. A Tweet will 
 * not always be returned in the current_status field.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "user_id" => "564646461",
    "screen_name" => "Vlkaschaudhary",
    "include_entities" => false,
);


$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("users/contributees", $params);
print_r($settings);
?>