<?php

/**
 * GET search/tweets
 * 
 * @desc Returns a collection of relevant Tweets matching a specified query. Please note that 
 * Twitter's search service and, by extension, the Search API is not meant to be an exhaustive 
 * source of Tweets. Not all Tweets will be indexed or made available via the search interface. 
 * In API v1.1, the response format of the Search API has been improved to return Tweet 
 * objects more similar to the objects you'll find across the REST API and platform. You may 
 * need to tolerate some inconsistencies and variance in perspectival values (fields that 
 * pertain to the perspective of the authenticating user) and embedded user objects. To learn 
 * how to use Twitter Search effectively, consult our guide to Using the Twitter Search API. 
 * See Working with Timelines to learn best practices for navigating results by since_id and 
 * max_id.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();

/**
 * @param q required
 * A UTF-8, URL-encoded search query of 1,000 characters maximum, including operators. 
 * Queries may additionally be limited by complexity. Example Values: @noradio
 */
$params['q'] = 'google';
/**
 * @param geocode  optional
 * Returns tweets by users located within a given radius of the given latitude/longitude. 
 * The location is preferentially taking from the Geotagging API, but will fall back to 
 * their Twitter profile. The parameter value is specified by "latitude,longitude,radius", 
 * where radius units must be specified as either "mi" (miles) or "km" (kilometers). 
 * Note that you cannot use the near operator via the API to geocode arbitrary locations; 
 * however you can use this geocode parameter to search near geocodes directly. A maximum 
 * of 1,000 distinct "sub-regions" will be considered when using the radius modifier. 
 * Example Values: 37.781157,-122.398720,1mi
 * 
 */
#$params['geocode'] = '37.781157,-122.398720,1mi';
/**
 * @param lang optional
 * Restricts tweets to the given language, given by an ISO 639-1 code. Language detection 
 * is best-effort. Example Values: eu
 */
#$params['lang'] = 'eu';

/**
 * @param locale optional
 * Specify the language of the query you are sending (only ja is currently effective). This 
 * is intended for language-specific consumers and the default should work in the majority 
 * of cases. Example Values: ja
 */
#$params['locale'] = 'en';

/**
 * @param result_type optional
 * Optional. Specifies what type of search results you would prefer to receive. The current
 * default is "mixed." Valid values include:
 * mixed: Include both popular and real time results in the response.
 * recent: return only the most recent results in the response
 * popular: return only the most popular results in the response.
 * Example Values: mixed, recent, popular
 */
#$params['result_type'] = 'mixed';

/**
 * @param count optional
 * The number of tweets to return per page, up to a maximum of 100. Defaults to 15. This was 
 * formerly the "rpp" parameter in the old Search API. Example Values: 100
 */
$params['count'] = 100;

/**
 * @param  untill optional
 * Returns tweets generated before the given date. Date should be formatted as YYYY-MM-DD. 
 * Keep in mind that the search index may not go back as far as the date you specify here. 
 * Example Values: 2012-09-01
 */
#$params['untill'] = '2013-01-01';

/**
 * @param since_id optional
 * Returns results with an ID greater than (that is, more recent than) the specified ID. 
 * There are limits to the number of Tweets which can be accessed through the API. If the 
 * limit of Tweets has occured since the since_id, the since_id will be forced to the 
 * oldest ID available. Example Values: 12345
 */
#$params['since_id'] = 12345;

/**
 * @param max_id optional
 * Returns results with an ID less than (that is, older than) or equal to the specified ID. 
 * Example Values: 54321
 * 
 */
#$params['max_id'] = 54321;

/**
 * @param include_entities optional
 * The entities node will be disincluded when set to false. Example Values: false
 */
#$params['include_entities'] = false;

/**
 * @param callback optional
 * If supplied, the response will use the JSONP format with a callback of the given name. 
 * The usefulness of this parameter is somewhat diminished by the requirement of 
 * authentication for requests to this endpoint. Example Values: processTweets
 * 
 */
#$params['callback'] = 'processTweets';

/**
 * Process Twitter Auth
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$search = $twitter->get("search/tweets", $params);
print_r($search);