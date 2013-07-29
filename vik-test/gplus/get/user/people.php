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
    $user_id = isset($_GET['user']) && !empty($_GET['user']) ? $_GET['user'] : 'me';
    $me = $plus->people->get($user_id);
    $me_id = isset($me['id']) && !empty($me['id']) ? $me['id'] : $user_id;
    $people = $plus->people->listPeople($me_id, 'visible');
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    header("Location: http://localhost/vik-test/public/?service=gplus");
}

if (isset($me['url']) && !empty($me['url'])) {

    $url = filter_var($me['url'], FILTER_VALIDATE_URL);
    $img = filter_var($me['image']['url'], FILTER_VALIDATE_URL);
    $name = filter_var($me['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $name ?></title>
        <link rel='stylesheet' href='style.css' />
        <link rel="shortcut icon" href="<?= $img ?>">    
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
            <?php if (isset($people['totalItems']) && $people['totalItems'] > 0): ?>
                <div class="activities">
                    <h3><?= $people['title'] ?> (<?= $people['totalItems'] ?>)</h3>
                    <ul class="people">

                        <?php foreach ($people['items'] as $key => $val): ?>

                            <li id="people-<?= ++$key ?>">
                                <div class="people-img">
                                    <img src="<?= $val['image']['url'] ?>" />
                                </div>
                                <div class="people-name">
                                    <a href="http://localhost/vik-test/public/?service=gplus/get/user/activity&user=<?= $val['id'] ?>">
                                        <span><?= $val['displayName'] ?></span>
                                    </a>
                                </div>
                                <div class="clearfix"></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="clearfix"></div>
            <?php endif ?>
        </div>
    </body>
</html>
