<?php

/**
 * GET statuses/retweets/:id
 * 
 * @desc Returns up to 100 of the first retweets of a given tweet.
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
#$params['count'] = true;
/**
 * @param count (optional)
 * Specifies the number of records to retrieve. Must be less than or equal to 100.
 */

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/retweets/:id", $params);
print_r($statuses);
?>