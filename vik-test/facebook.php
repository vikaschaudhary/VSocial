<?php

use VSocial\Plugin\FacebookAuth;

$config = require_once 'config/config.php';

$facebook = new FacebookAuth($config['facebook']['app_id'], $config['facebook']['app_secret'], $config['facebook']['scope']);

$fbuser = $facebook->validateAuth();
if ($fbuser) {
    $facebook_session = array();
    $facebook_session['fb_user_id'] = $fbuser['id'];
    $facebook_session['access_token'] = $facebook->getAccessToken();
    header("Location: http://localhost/vik-test/public/?service=facebook_options");
    exit;
    /**
     * Post On Own Wall
     */
    //$facebook->postOnWall($message);
    /**
     * Get Friends List
     */
    #$from = array("id" => $fbuser['id'], "name" => $fbuser['name']);
    #  $friends = $facebook->getFriends();
    # if (sizeof($friends) > 0) {
    #  $message = "hello how are you check this http://www.google.com";
    #  foreach ($friends as $friend) {
    #if (isset($friend['username'])) {
    /**
     * Required Username
     */
    #   $username = $friend['username'];
    #   $facebook->sendMailMessage($username, $message);
    #}
    /**
     * Post on frineds wall
     */
    //$facebook->postOnFriendsWall($friend['id'], $message);
    /**
     * Send private message
     */
    #$to = array("id" => $friend['id'], "name" => $friend['name']);
    /**
     * To post on wall
     */
    # $facebook->fbChat($friend['id'], $message);
    #}
    #}
} else {
    $login_url = $facebook->getLoginUrl(true);
    header("Location: {$login_url}");
    exit;
}
?>
