<?php

/**
 * GET user
 * 
 * @desc Streams messages for a single user, 
 * @Overview User Streams provide a stream of data and events specific to the authenticated 
 * user. Note that User Streams are not intended for server-to-server connections. If you 
 * need to make connections on behalf of multiple users from the same machine. 
 * 
 * Minimize the number of connections your application makes to User Streams. Each Twitter 
 * account is limited to only a few simultaneous User Streams connections per OAuth 
 * application, regardless of IP. Once the per-application limit is exceeded, the oldest 
 * connection will be terminated. An account logging in from too many instances of the same 
 * OAuth application will cycle connections as the application instances reconnect and 
 * disconnect each other.
 * 
 * https://dev.twitter.com/docs/streaming-apis/streams/user
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];
require_once 'twitter/validation.php';

/**
 * Requried Parameters
 */
$params = array();
/**
 * @param delimited optional
 * 
 * This parameter may be used on all streaming endpoints, unless explicitly noted.
 * Setting this to the string length indicates that statuses should be delimited in the 
 * stream, so that clients know how many bytes to read before the end of the status message. 
 * Statuses are represented by a length, in bytes, a newline, and the status text that is 
 * exactly length bytes. Note that “keep-alive” newlines may be inserted before each length.
 *
 * As an example, consider this response to a request to 
 * https://stream.twitter.com/1.1/statuses/filter.json?delimited=length&track=twitterapi:
 * 
 * HTTP/1.1 200 OK
 * Content-Type: application/json
 * Transfer-Encoding: chunked
 * 1953
 * {"retweet_count":0,"text":"Man I like me some @twitterapi","entities":{"urls":[],"hashtags":[],"user_mentions":[{"indices":[19,30],"name":"Twitter API","id":6253282,"screen_name":"twitterapi","id_str":"6253282"}]},"retweeted":false,"in_reply_to_status_id_str":null,"place":null,"in_reply_to_user_id_str":null,"coordinates":null,"source":"web","in_reply_to_screen_name":null,"in_reply_to_user_id":null,"in_reply_to_status_id":null,"favorited":false,"contributors":null,"geo":null,"truncated":false,"created_at":"Wed Feb 29 19:42:02 +0000 2012","user":{"is_translator":false,"follow_request_sent":null,"statuses_count":142,"profile_background_color":"C0DEED","default_profile":false,"lang":"en","notifications":null,"profile_background_tile":true,"location":"","profile_sidebar_fill_color":"ffffff","followers_count":8,"profile_image_url":"http:\/\/a1.twimg.com\/profile_images\/1540298033\/phatkicks_normal.jpg","contributors_enabled":false,"profile_background_image_url_https":"https:\/\/si0.twimg.com\/profile_background_images\/365782739\/doof.jpg","description":"I am just a testing account, following me probably won't gain you very much","following":null,"profile_sidebar_border_color":"C0DEED","profile_image_url_https":"https:\/\/si0.twimg.com\/profile_images\/1540298033\/phatkicks_normal.jpg","default_profile_image":false,"show_all_inline_media":false,"verified":false,"profile_use_background_image":true,"favourites_count":1,"friends_count":5,"profile_text_color":"333333","protected":false,"profile_background_image_url":"http:\/\/a3.twimg.com\/profile_background_images\/365782739\/doof.jpg","time_zone":"Pacific Time (US & Canada)","created_at":"Fri Sep 09 16:13:20 +0000 2011","name":"fakekurrik","geo_enabled":true,"profile_link_color":"0084B4","url":"http:\/\/blog.roomanna.com","id":370773112,"id_str":"370773112","listed_count":0,"utc_offset":-28800,"screen_name":"fakekurrik"},"id":174942523154894848,"id_str":"174942523154894848"}
 * 
 * The 1953 indicates how many bytes to read off of the stream to get the rest of the 
 * Tweet (including \r\n). The next length delimiter will occur exactly after 1953 bytes
 */
#$params['delimited'] = 'Specifies whether messages should be length-delimited';
/**
 * @param stall_warnings optional
 * 
 * This parameter may be used on all streaming endpoints, unless explicitly noted. Setting 
 * this parameter to the string true will cause periodic messages to be delivered if the 
 * client is in danger of being disconnected. These messages are only sent when the client 
 * is falling behind, and will occur at a maximum rate of about once every 5 minutes. This 
 * parameter is most appropriate for clients with high-bandwidth connections, such as the 
 * firehose.
 */
#$params['stall_warnings'] = 'Specifies whether stall warnings should be delivered.';
/**
 * @param with optional
 * Available on GET user and GET site. The with parameter controls the types of messages 
 * delivered to User and Site Streams clients. The default for Site Streams is with=user, 
 * which only streams messages from the user associated with the stream. The default for 
 * User Streams is with=followings which adds messages from accounts the user follows, 
 * equivalent to the user's home timeline. Despite the difference in defaults, Site and 
 * User each accept both user and followings parameter values.
 */
#$params['with'] = 'Specifies whether to return information for just the authenticating user, or include messages from accounts the user follows.';
/**
 * @param replies optional
 * 
 * Available on GET user and GET site. By default @replies are only sent if the current user 
 * follows both the sender and receiver of the reply. For example, consider the case where 
 * Alice follows Bob, but Alice doesn’t follow Carol. By default, if Bob @replies Carol, 
 * Alice does not see the Tweet. This mimics twitter.com and api.twitter.com behavior. 
 * To have such Tweets returned in a streaming connection, specify replies=all when 
 * connecting.
 */
#$params['replies'] = 'all';
/**
 * @param follow
 * 
 * A comma-separated list of phrases which will be used to determine what Tweets will be delivered on the stream. A phrase may be one or more terms separated by spaces, and a phrase will match if all of the terms in the phrase are present in the Tweet, regardless of order and ignoring case. By this model, you can think of commas as logical ORs, while spaces are equivalent to logical ANDs (e.g. ‘the twitter’ is the AND twitter, and ‘the,twitter’ is the OR twitter).
 * The text of the Tweet and some entity fields are considered for matches. Specifically, the text attribute of the Tweet, expanded_url and display_url for links and media, text for hashtags, and screen_name for user mentions are checked for matches.
 * Each phrase must be between 1 and 60 bytes, inclusive. Exact matching of phrases (equivalent to quoted phrases in most search engines) is not supported.
 * Punctuation and special characters will be considered part of the term they are adjacent to. In this sense, "hello." is a different track term than "hello". However, matches will ignore punctuation present in the Tweet. So "hello" will match both "hello world" and "my brother says hello." Note that punctuation is not considered to be part of a #hashtag or @mention, so a track term containing punctuation will not match either #hashtags or @mentions.
 * UTF-8 characters will match exactly, even in cases where an "equivalent" ASCII character exists. For example, "touché" will not match a Tweet containing "touche".
 * Non-space separated languages, such as CJK and Arabic, are currently unsupported.
 * URLs are considered words for the purposes of matches which means that the entire domain and path must be included in the track query for a Tweet containing an URL to match. Note that display_url does not contain a protocol, so this is not required to perform a match.
 * Twitter currently canonicalizes the domain "www.example.com" to "example.com" before the match is performed, so omit the "www" from URL track terms.
 * Track examples:
 * Parameter value	
 *  - Twitter
 * Will match...
 *  - TWITTER	 
 *  - Twitter	 
 *  - twitter
 *  - "Twitter"
 *  - twitter.
 *  - #twitter
 *  - @twitter	
 *  - http://twitter.com	
 * Will not match...
 *  - TwitterTracker
 *  - #newtwitter
 * 
 * Parameter value
 *  - Twitter's	
 * Will match...
 *  - I like Twitter's new design	 
 * Will not match...
 *  - Someday I'd like to visit @Twitter's office 
 * 
 * Parameter value
 *  - twitter api,twitter streaming
 * Will match...
 *  - The Twitter API is awesome
 *  - The twitter streaming service is fast
 *  - Twitter has a streaming API
 * Will not match...
 *  - I'm new to Twitter
 * 
 * 
 * Parameter value
 *  - example.com
 * Will match...
 *  - Someday I will visit example.com 
 * Will not match...
 *  - There is no example.com/foobarbaz
 * 
 * Parameter value
 *  - example.com/foobarbaz
 * Will match...
 *  - example.com/foobarbaz
 *  - www.example.com/foobarbaz
 * Will not match...
 *  - example.com
 * 
 * Parameter value
 *  - www.example.com/foobarbaz
 * Will match...
 *  - example.com/foobarbaz
 *  - www.example.com/foobarbaz
 * Will not match...
 *  - www.example.com/foobarbaz
 * 
 * To have a better feeling of the keywords that match the content of a tweet, you can 
 * try interactively on the Streaming API keyword matching page.
 * https://dev.twitter.com/docs/streaming-apis/keyword-matching
 */
#$params['track'] = 'Keywords to track.';
/**
 * @param locations optional
 * 
 * A comma-separated list of longitude,latitude pairs specifying a set of bounding boxes 
 * to filter Tweets by. On geolocated Tweets falling within the requested bounding boxes 
 * will be included—unlike the Search API, the user’s location field is not used to filter 
 * tweets. Each bounding box should be specified as a pair of longitude and latitude pairs,
 * with the southwest corner of the bounding box coming first. 
 * For example:
 * Parameter value                              Tracks Tweets from...
 *  -122.75,36.8,-121.75,37.8                   San Francisco
 *  -122.75,36.8,-121.75,37.8                   New York City
 *  -122.75,36.8,-121.75,37.8,-74,40,-73,41     San Francisco OR New York City
 *  --180,-90,180,90                            Any geotagged Tweet
 * 
 * Bounding boxes do not act as filters for other filter parameters. For example 
 * track=twitter&locations=-122.75,36.8,-121.75,37.8 would match any tweets containing the 
 * term Twitter (even non-geo tweets) OR coming from the San Francisco area. The streaming 
 * API uses the following heuristic to determine whether a given Tweet falls within a 
 * bounding box: If the coordinates field is populated, the values there will be tested 
 * against the bounding box. Note that this field uses geoJSON order (longitude, latitude).
 * If coordinates is empty but place is populated, the region defined in place is checked 
 * for intersection against the locations bounding box. Any overlap will match. If none of 
 * the rules listed above match, the Tweet does not match the location query. Note that the 
 * geo field is deprecated, and ignored by the streaming API. If you would like to exclude 
 * place matches or only include places which fall completely within the bounding box, your
 * code will have to perform an additional filtering step after reading the filtered stream.
 * Note that native Retweets are not matched by this parameter. While the original Tweet 
 * may have a location, the Retweet will not.
 */
#$params['locations'] = 'Specifies a set of bounding boxes to track';

/**
 * Twitter API Process
 */
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$search = $twitter->get("user", $params);
print_r($search);
?>