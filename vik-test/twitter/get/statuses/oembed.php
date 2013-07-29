<?php

/**
 * GET statuses/oembed
 * 
 * @desc Returns information allowing the creation of an embedded representation of a 
 * Tweet on third party sites. See the oEmbed specification for information about the
 * response format. While this endpoint allows a bit of customization for the final 
 * appearance of the embedded Tweet, be aware that the appearance of the rendered Tweet
 * may change over time to be consistent with Twitter's Display Requirements. Do not 
 * rely on any class or id parameters to stay constant in the returned markup.
 */
?>
<?php
use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

$params = array();
/**
 * @param id (required)
 * The numerical ID of the desired status.
 */
$params['id'] = 327473909412814850;
/**
 * @param url (required)
 * The URL of the Tweet/status to be embedded. 
 * To embed the Tweet at https://twitter.com/#!/twitter/status/99530515043983360, use:
 * https://twitter.com/#!/twitter/status/99530515043983360
 * To embed the Tweet at https://twitter.com/twitter/status/99530515043983360, use:
 * https://twitter.com/twitter/status/99530515043983360
 */
$params['url'] = 'https://twitter.com/twitter/status/99530515043983360';
/**
 * @param maxwidth 
 * The maximum width in pixels that the embed should be rendered at. This value is 
 * constrained to be between 250 and 550 pixels. Note that Twitter does not support the 
 * oEmbed maxheight parameter. Tweets are fundamentally text, and are therefore of 
 * unpredictable height that cannot be scaled like an image or video. Relatedly, the 
 * oEmbed response will not provide a value for height. Implementations that need consistent 
 * heights for Tweets should refer to the hide_thread and hide_media parameters below.
 */
$params['maxwidth'] = 325;
/**
 * @param hide_media 
 * Specifies whether the embedded Tweet should automatically expand images which were 
 * uploaded via POST statuses/update_with_media. When set to either true, t or 1 images 
 * will not be expanded. Defaults to false.
 */
$params['hide_media'] = true;
/**
 * @param hide_thread 
 * Specifies whether the embedded Tweet should automatically show the original message in 
 * the case that the embedded Tweet is a reply. When set to either true, t or 1 the 
 * original Tweet will not be shown. Defaults to false.
 */
$params['hide_thread'] = true;
/**
 * @param omit_script 
 * Specifies whether the embedded Tweet HTML should include a <script> element pointing 
 * to widgets.js. In cases where a page already includes widgets.js, setting this value 
 * to true will prevent a redundant script element from being included. When set to either 
 * true, t or 1 the <script> element will not be included in the embed HTML, meaning that 
 * pages must include a reference to widgets.js manually. Defaults to false.
 */
$params['omit_script'] = true;
/**
 * @param align 
 * Specifies whether the embedded Tweet should be left aligned, right aligned, or centered 
 * in the page. Valid values are left, right, center, and none. Defaults to none, 
 * meaning no alignment styles are specified for the Tweet.
 */
$params['align'] = 'center';
/**
 * @param related 
 * A value for the TWT related parameter, as described in Web Intents. 
 * This value will be forwarded to all Web Intents calls.
 * twitterapi,twittermedia,twitter
 */
$params['related'] = 'twitter';
/**
 * @param lang
 * Language code for the rendered embed. This will affect the text and 
 * localization of the rendered HTML
 */
$params['lang'] = 'en';

$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$statuses = $twitter->get("statuses/oembed", $params);
print_r($statuses);
?>