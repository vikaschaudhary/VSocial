<?php

use VSocial\Plugin\FacebookAuth;

$config = require_once 'config/config.php';

$facebook = new FacebookAuth($config['facebook']['app_id'], $config['facebook']['app_secret'], $config['facebook']['scope']);
$fbuser = $facebook->validateAuth();
if ($fbuser) {
    #$image = $facebook->getUserLikes();    
    $image = $facebook->countLikes($fbuser['id']);
    print_r(count($image));
} else {
    $login_url = $facebook->getLoginUrl();
    header("Location: {$login_url}");
    exit;
}
?>
