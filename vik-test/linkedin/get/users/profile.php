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
#$fields = "id,first-name,last-name,headline,location,industry,distance,summary,specialties,picture-url,positions,public-profile-url,";
$fields = "id,first-name,last-name,headline,industry,picture-url,public-profile-url,email-address";
#$fields .= "email-address,associations,interests,educations,languages,skills,following,phone-numbers,connections";
#$fields .= "email-address,phone-numbers,connections";
$linkedin = new LinkedInAuth($consumer_key, $consumer_secret, $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $linkedin->get("~:($fields)", $authSession);
print_r($settings);
?>