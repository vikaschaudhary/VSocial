<?php

/**
 * POST statuses/retweet/:id
 * 
 * @desc Retweets a tweet. Returns the original tweet with retweet details embedded.
 * Use the OAuth tool in this page sidebar to generate the OAuth signature for this request.
 * 
 * 
 * Usage Notes:
 * This method is subject to update limits. A HTTP 403 will be returned if this limit 
 * as been hit. Twitter will ignore attempts to perform duplicate retweets.
 * The retweet_count will be current as of when the payload is generated and may not 
 * reflect the exact count. It is intended as an approximation.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';


$params = array();
/**
 * @param trim_user (optional)
 * When set to either true, t or 1, each tweet returned in a timeline will include a user object including only the status authors numerical ID. Omit this parameter to receive the complete user object.
 */
$params['trim_user'] = true;
/**
 * @param id (required)
 * The numerical ID of the desired status.
 */
$params['id'] = 123;

/**
 * Starts twitter api process
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->post("statuses/destroy/:id", $params);
print_r($statuses);
?>