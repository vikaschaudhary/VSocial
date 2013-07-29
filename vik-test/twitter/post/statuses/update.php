<?php

/**
 * POST statuses/update
 * 
 * @desc Updates the authenticating user's current status, also known as tweeting. To upload 
 * an image to accompany the tweet, use POST statuses/update_with_media. For each update 
 * attempt, the update text is compared with the authenticating user's recent tweets. Any 
 * attempt that would result in duplication will be blocked, resulting in a 403 error. 
 * Therefore, a user cannot submit the same status twice in a row. While not rate limited 
 * by the API a user is limited in the number of tweets they can create at a time. If the 
 * number of updates posted by the user reaches the current allowed limit this method will 
 * return an HTTP 403 error.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';


$params = array();
/**
 * @param status (required)
 * 
 * The text of your status update. URL encode as necessary. t.co link wrapping may affect 
 * character counts if the post contains URLs. You must additionally account for the 
 * characters_reserved_per_media per uploaded media, additionally accounting for space 
 * characters in between finalized URLs.
 * 
 * @Note: Request the GET help/configuration endpoint to get the current 
 * characters_reserved_per_media and max_media_per_upload values.
 */
$params['status'] = 'The text of your status update.';

/**
 * @param (optional)
 * Set to true for content which may not be suitable for every audience.
 */
$params['possibly_sensitive'] = true;
/**
 * @param in_reply_to_status_id (optional)
 * 
 * The ID of an existing status that the update is in reply to.
 * 
 * @Note: This parameter will be ignored unless the author of the tweet this parameter 
 * references is mentioned within the status text. Therefore, you must include 
 * @username, where username is the author of the referenced tweet, within the update.
 */
$params['in_reply_to_status_id'] = 'The ID of an existing status';
/**
 * @param lat (optional)
 * The latitude of the location this tweet refers to. This parameter will be ignored 
 * unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. 
 * It will also be ignored if there isn't a corresponding long parameter.
 */
$params['lat '] = '37.7821120598956';
/**
 * @param long (optional)
 * The longitude of the location this tweet refers to. The valid ranges for 
 * longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter 
 * will be ignored if outside that range, not a number, geo_enabled is disabled, 
 * or if there not a corresponding lat parameter.
 */
$params['long '] = '-122.400612831116';
/**
 * @param place_id (optional)
 * A place in the world identified by a Twitter place ID. Place IDs can be retrieved 
 * from geo/reverse_geocode.
 */
$params['place_id'] = 'df51dec6f4ee2b2c';
/**
 * @param display_coordinates (optional)
 * Whether or not to put a pin on the exact coordinates a tweet has been sent from.
 */
$params['display_coordinates'] = true;
/**
 * @param trim_user (optional)
 * When set to either true, t or 1, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
 */
$params['trim_user'] = true;

/**
 * Twitter api process
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->post("statuses/update", $params);
print_r($statuses);
?>