<?php

/**
 * @method GET
 * users/profile
 */
use VSocial\Plugin\LinkedInAuth;
use VSocial\Utils\ToXML;

$config = require_once 'config/config.php';

$linkedConfig = $config['linked_in'];
$consumer_key = $linkedConfig['api_key'];
$consumer_secret = $linkedConfig['secret_key'];
require_once 'linkedin/validation.php';

$share = array(
    "comment" => "Check out the LinkedIn Share API!",
    "content" => array(
        "title" => "LinkedIn Developers Documentation On Using the Share API",
        "description" => "Leverage the Share API to maximize engagement on user-generated content on LinkedIn",
        "submitted-url" => "https://developer.linkedin.com/documents/share-api",
        "submitted-image-url" => "http://m3.licdn.com/media/p/3/000/124/1a6/089a29a.png",
    ),
    "visibility" => array(
        "code" => "anyone",
    ),
);


$xml = ToXML::createXML('share', $share);
$data = $xml->saveXML();

$linkedin = new LinkedInAuth($consumer_key, $consumer_secret, $authSession['oauth_token'], $authSession['oauth_token_secret']);
$settings = $linkedin->post("~/shares", $authSession);
print_r($settings);
?>