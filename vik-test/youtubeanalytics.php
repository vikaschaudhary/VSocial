<?php

use VSocial\Google\Client;

$config = require_once 'config/config.php';
$googleConfig = $config['google'];
$googleConfig['oauth2_client_id'] = '440535774774-ff67cbgmk6vlb6qedtu3b96ugkpl9d2q.apps.googleusercontent.com';
$googleConfig['oauth2_client_secret'] = 'pQvGzaWjVIC70UPhMPbpk8fp';
$googleConfig['oauth2_redirect_uri'] = 'http://localhost/vik-test/public/?service=youtubeanalytics_connect';
\VSocial\Utils\Storage::set("config", $googleConfig);
$client = new Client($googleConfig);

if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
}

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

if (isset($_SESSION['access_token'])) {
    $client->setAccessToken($_SESSION['access_token']);
}

if ($client->getAccessToken()) {
    $authUrl = "http://localhost/vik-test/public/?service=youtube_connect";
} else {
    $authUrl = $client->createAuthUrl();
}
#echo "<pre>".$authUrl;exit;
header("Location: {$authUrl}");