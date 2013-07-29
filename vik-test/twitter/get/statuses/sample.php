<?php

/**
 * GET statuses/sample
 * 
 * @desc Returns a small random sample of all public statuses. The Tweets returned by 
 * the default access level are the same, so if two different clients connect to this 
 * endpoint, they will see the same Tweets.
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();

#$params['delimited'] = '';
/**
 * @param delimited (optional)
 * Specifies whether messages should be length-delimited. See the delimited parameter 
 * documentation for more information.
 */
#$params['stall_warnings'] = '245446';

/**
 * @param stall_warnings (optional)
 * 
 * Specifies whether stall warnings should be delivered. See the stall_warnings parameter 
 * documentation for more information.
 */

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/sample", $params);
print_r($statuses);
?>