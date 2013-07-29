<?php

/**
 * @method GET
 * users/profile
 */
use VSocial\Plugin\LinkedInAuth;

$config = require_once 'config/config.php';

$linkedConfig = $config['linked_in'];
$consumer_key = $linkedConfig['api_key'];
$consumer_secret = $linkedConfig['secret_key'];
require_once 'linkedin/validation.php';
$fields = "connections";
$linkedin = new LinkedInAuth($consumer_key, $consumer_secret, $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $linkedin->get("~:($fields)", $authSession);
print_r($settings);
?>