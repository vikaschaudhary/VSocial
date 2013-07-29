<?php

use VSocial\Google\Client;

$config = require_once 'config/config.php';
$googleConfig = $config['google'];
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
    $authUrl = "http://localhost/vik-test/public/?service=gplus_connect";
} else {
    $authUrl = $client->createAuthUrl();
}

header("Location: {$authUrl}");