<?php

/**
 * POST blocks/destroy
 * 
 * @desc Un-blocks the user specified in the ID parameter for the authenticating user. 
 * Returns the un-blocked user in the requested format when successful. 
 * If relationships existed before the block was instated, they will not be restored.
 * 
 * @param screen_name optional
 * The screen name of the potentially blocked user. Helpful for disambiguating when a 
 * valid screen name is also a user ID.
 * @params user_id optional
 * The ID of the potentially blocked user. Helpful for disambiguating when a valid user 
 * ID is also a valid screen name.
 * @param include_entities optional
 * The entities node will not be included when set to false.
 * @params skip_status optional
 * When set to either true, t or 1 statuses will not be included in the returned user objects.
 */
?>
<?php

use VSocial\Plugin\TwitterAuth;

$params = array(
    "screen_name" => 'Vlkaschaudhry',
    "include_entities" => false,
    "skip_status" => false
);
$config = require_once 'config/config.php';
$twitterConfig = $config['twitter'];

require_once 'twitter/validation.php';
$twitter = new TwitterAuth($twitterConfig['consumer_key'], $twitterConfig['consumer_secret'], $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $twitter->post("blocks/destroy", $params);
print_r($settings);
?>