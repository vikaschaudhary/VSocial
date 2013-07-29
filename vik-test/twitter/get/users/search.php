<?php

/**
 * GET users/search
 * 
 * @desc Provides a simple, relevance-based search interface to public user accounts 
 * on Twitter. Try querying by topical interest, full name, company name, location, or 
 * other criteria. Exact match searches are not supported.
 * Only the first 1,000 matching results are available.
 * 
 * @param q  (required)
 * The search query to run against people search. (twiiter)
 * 
 * @param page (optional) 
 * The number of potential user results to retrieve per page. This value has a maximum of 20.
 * @example 5
 * 
 * @param include_entities (optional) 
 * The entities node will be disincluded from embedded tweet objects when set to false.
 * 
 * https://api.twitter.com/1.1/users/search.json
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "q" => "IndiaNIC",
    "page" => 1,
    "include_entities" => false
);


$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->get("users/search", $params);
print_r($settings);
?>