<?php

use VSocial\Google\Client;
use VSocial\Google\Api;

$config = require_once 'config/config.php';
$googleConfig = $config['google'];
/**
 * Set COnfig
 */
\VSocial\Utils\Storage::set("config", $googleConfig);

$client = new Client($googleConfig);

$plus = new Api\Plus($client);


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
    $me = $plus->people->get('me');
    $optParams = array('maxResults' => 100);
    $people = $plus->people->listPeople('me', 'visible');
    $activities = $plus->activities->listActivities('me', 'public', $optParams);
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    header("Location: http://localhost/vik-test/public/?service=gplus");
}
?>
<?php
#echo "<pre>";print_r($activities);exit;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel='stylesheet' href='style.css' />
    </head>
    <body>
        <header class="top">
            <h1>Google+ Sample App</h1>            
        </header>
        <?php if (isset($me['url']) && !empty($me['url'])): ?>
            <?php
            $url = filter_var($me['url'], FILTER_VALIDATE_URL);
            $img = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
            $name = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            ?>
            <div class="me">
                <div class="me-img">
                    <img src="<?= $img ?>" />
                </div>
                <div class="me-name">
                    <a href="<?= $url ?>">
                        <span><?= $name ?></span>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>

        <?php endif; ?>
        <div class="box">
            <ul>
                <li>
                    <a href="http://localhost/vik-test/public/?service=gplus/get/user/people">Get User People</a>
                </li>
            </ul>
        </div>
    </body>
</html>
