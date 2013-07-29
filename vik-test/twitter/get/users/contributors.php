<?php

/**
 * GET users/contributors
 * 
 * @desc Returns a collection of users who can contribute to the specified account.

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
 * @param skip_status  (optional) 
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 * 
 * https://api.twitter.com/1.1/users/contributees.json
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "user_id" => "564646461",
    "screen_name" => "Vlkaschaudhary",
    "include_entities" => true,
    "skip_status" => 0,
);
unset($params['user_id']);

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("users/contributees", $params);
print_r($settings);
?>
