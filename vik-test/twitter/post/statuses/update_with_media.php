<?php

/**
 * POST statuses/update_with_media
 * 
 * @desc Updates the authenticating user's current status and attaches media for upload. 
 * In other words, it creates a Tweet with a picture attached. Unlike POST statuses/update,
 * this method expects raw multipart data. Your POST request's Content-Type should be set 
 * to multipart/form-data with the media[] parameter The Tweet text will be rewritten to 
 * include the media URL(s), which will reduce the number of characters allowed in the 
 * Tweet text. If the URL(s) cannot be appended without text truncation, the tweet will be 
 * rejected and this method will return an HTTP 403 error. 
 * 
 * Important: In API v1.1, you now use api.twitter.com as the domain instead of 
 * upload.twitter.com. We strongly recommend using SSL with this method.
 * 
 * Important: In API v1.1, you now use api.twitter.com as the domain instead of 
 * upload.twitter.com. We strongly recommend using SSL with this method.
 * 
 * Users are limited to a specific daily media upload limit.. Requests to this endpoint 
 * will return the following headers with information regarding the user's current media 
 * upload limits:
 * 
 * @X-MediaRateLimit-Limit - Indicates the total pieces of media the current user may upload 
 * before the time indicated in X-MediaRateLimit-Reset.
 * @X-MediaRateLimit-Remaining - The remaining pieces of media the current user may upload 
 * before the time indicated in X-MediaRateLimit-Reset.
 * @X-MediaRateLimit-Reset - A UTC-based timestamp (in seconds) indicating when 
 * X-MediaRateLimit-Remaining will reset to the value in X-MediaRateLimit-Limit and the 
 * user can resume uploading media. 
 * 
 * If the user is over the daily media limit, this method 
 * will return an HTTP 403 error. In addition to media upload limits, the user is still 
 * limited in the number of statuses they can publish daily. If the user tries to exceed 
 * the number of updates allowed, this method will also return an HTTP 403 error, similar 
 * to POST statuses/update.
 * 
 * 
 * @Note: The OAuth tool does not support multipart requests, so you will not be able to 
 * use it to generate an example request to this endpoint. An example request has been 
 * included to demonstrate the multipart request format.
 * 
 * POST /1.1/statuses/update_with_media.json HTTP/1.1
 * Host: api.twitter.com
 * User-Agent: Go http package
 * Content-Length: 15532
 * Authorization: OAuth oauth_consumer_key="...", oauth_nonce="...", oauth_signature="...", oauth_signature_method="HMAC-SHA1", oauth_timestamp="1347058301", oauth_token="...", oauth_version="1.0"
 * Content-Type: multipart/form-data;boundary=cce6735153bf14e47e999e68bb183e70a1fa7fc89722fc1efdf03a917340
 * Accept-Encoding: gzip
 * --cce6735153bf14e47e999e68bb183e70a1fa7fc89722fc1efdf03a917340
 * Content-Disposition: form-data; name="status"
 * 
 * Hello 2012-09-07 15:51:41.375247 -0700 PDT!
 * --cce6735153bf14e47e999e68bb183e70a1fa7fc89722fc1efdf03a917340
 * Content-Type: application/octet-stream
 * Content-Disposition: form-data; name="media[]"; filename="media.png"
 * ...
 * --cce6735153bf14e47e999e68bb183e70a1fa7fc89722fc1efdf03a917340--
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
 * @param media[] (required)
 * 
 * Up to max_media_per_upload files may be specified in the request, each named media[]. 
 * Supported image formats are PNG, JPG and GIF. Animated GIFs are not supported. This 
 * data must be the raw image bytes - base64 encoded images are currently not supported.
 * 
 * @Note: Request the GET help/configuration endpoint to get the current 
 * max_media_per_upload and photo_size_limit values.
 */
$params['media[]'] = array();
/**
 * @param (optional)
 * Set to true for content which may not be suitable for every audience.
 */
#$params['possibly_sensitive'] = true;
/**
 * @param in_reply_to_status_id (optional)
 * 
 * The ID of an existing status that the update is in reply to.
 * 
 * @Note: This parameter will be ignored unless the author of the tweet this parameter 
 * references is mentioned within the status text. Therefore, you must include 
 * @username, where username is the author of the referenced tweet, within the update.
 */
#$params['in_reply_to_status_id'] = 'The ID of an existing status';
/**
 * @param lat (optional)
 * The latitude of the location this tweet refers to. This parameter will be ignored 
 * unless it is inside the range -90.0 to +90.0 (North is positive) inclusive. 
 * It will also be ignored if there isn't a corresponding long parameter.
 */
#$params['lat '] = '37.7821120598956';
/**
 * @param long (optional)
 * The longitude of the location this tweet refers to. The valid ranges for 
 * longitude is -180.0 to +180.0 (East is positive) inclusive. This parameter 
 * will be ignored if outside that range, not a number, geo_enabled is disabled, 
 * or if there not a corresponding lat parameter.
 */
#$params['long '] = '-122.400612831116';
/**
 * @param place_id (optional)
 * A place in the world identified by a Twitter place ID. Place IDs can be retrieved 
 * from geo/reverse_geocode.
 */
#$params['place_id'] = 'df51dec6f4ee2b2c';
/**
 * @param display_coordinates (optional)
 * Whether or not to put a pin on the exact coordinates a tweet has been sent from.
 */
#$params['display_coordinates'] = true;

/**
 * Twitter api process
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->post("statuses/destroy/:id", $params);
print_r($statuses);
?>