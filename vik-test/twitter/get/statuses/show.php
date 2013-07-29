<?php

/**
 * GET statuses/show/:id
 * 
 * @desc Returns a single Tweet, specified by the id parameter. The Tweet's author will 
 * also be embedded within the tweet. See Embeddable Timelines, Embeddable Tweets, 
 * and GET statuses/oembed for tools to render Tweets according to Display Requirements.
 * 
 * @About Geo
 * If there is no geotag for a status, then there will be an empty <geo/> or "geo" : {}. 
 * This can only be populated if the user has used the Geotagging API to send a statuses/update.
 * The JSON response mostly uses conventions laid out in GeoJSON. Unfortunately, 
 * the coordinates that Twitter renders are reversed from the GeoJSON specification 
 * (GeoJSON specifies a longitude then a latitude, whereas we are currently representing 
 * it as a latitude then a longitude). Our JSON renders as: 
 * "geo": { "type":"Point", "coordinates":[37.78029, -122.39697] }
 * 
 * @Contributors
 * If there are no contributors for a Tweet, then there will be an empty or 
 * "contributors" : {}. This field will only be populated if the user has contributors 
 * enabled on his or her account -- this is a beta feature that is not yet generally 
 * available to all.
 * This object contains an array of user IDs for users who have contributed to this status 
 * (an example of a status that has been contributed to is this one). In practice, there is 
 * usually only one ID in this array. The JSON renders as such "contributors":[8285392].
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();
/**
 * @param id required
 * The numerical ID of the desired Tweet. Example Values: 123
 */
$params['id'] = '245446';

/**
 * @param trim_user (optional)
 * 
 * When set to either true, t or 1, each tweet returned in a timeline will include 
 * a user object including only the status authors numerical ID. Omit this parameter 
 * to receive the complete user object.
 */
#$params['trim_user'] = true;
/**
 * @param include_my_retweet (optional)
 * 
 * When set to either true, t or 1, any Tweets returned that have been retweeted by 
 * the authenticating user will include an additional current_user_retweet node, 
 * containing the ID of the source status for the retweet.
 */
#$params['include_my_retweet'] = true;
/**
 * @param include_entities (optional)
 * The entities node will be disincluded when set to false.
 */
#$params['include_entities'] = false;

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/show/:id", $params);
print_r($statuses);
?>

