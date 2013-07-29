<?php

use VSocial\Google\Client;
use VSocial\Google\Api;
use VSocial\Google\Service;
use VSocial\Google\GoogleException;

$config = require_once 'config/config.php';
$googleConfig = $config['google'];
$googleConfig['oauth2_client_id'] = '440535774774-pboo7na3trpkgjfnq8l1o5ab4k11gvef.apps.googleusercontent.com';
$googleConfig['oauth2_client_secret'] = 'YYCwXQyTDZJWdEl2JSUW_aKx';
$googleConfig['oauth2_redirect_uri'] = 'http://localhost/vik-test/public/?service=youtube_connect';
/**
 * Set COnfig
 */
\VSocial\Utils\Storage::set("config", $googleConfig);

$client = new Client($googleConfig);

$youtube = new Api\YouTube($client);


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
    $htmlBody = '';
    try {
        /**
         * Videos
         */
        $videos = $youtube->videos->listVideos("yXWHnzx19ss","snippet", array());
        echo "<pre>";
        print_r($videos);
        exit;
        /**
         * activities
         */
        $activitiesResponse = $youtube->activities->listActivities('snippet', array(
            'maxResults' => 50,
            'home' => 'false',
        ));
        echo "<pre>";
        print_r($activitiesResponse);
        exit;
        /**
         * Channle
         */
        $channelsResponse = $youtube->channels->listChannels('contentDetails', array(
            'mine' => 'true',
        ));


        foreach ($channelsResponse['items'] as $channel) {
            $uploadsListId = $channel['contentDetails']['relatedPlaylists']['uploads'];

            $playlistItemsResponse = $youtube->playlistItems->listPlaylistItems('snippet', array(
                'playlistId' => $uploadsListId,
                'maxResults' => 50
            ));

            $htmlBody .= "<h3>Videos in list $uploadsListId</h3><ul>";
            foreach ($playlistItemsResponse['items'] as $playlistItem) {
                $htmlBody .= sprintf('<li>%s (%s)</li>', $playlistItem['snippet']['title'], $playlistItem['snippet']['resourceId']['videoId']);
            }
            $htmlBody .= '</ul>';
        }
    } catch (Service\ServiceException $e) {
        $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
    } catch (GoogleException $e) {
        $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>', htmlspecialchars($e->getMessage()));
    }
    $_SESSION['access_token'] = $client->getAccessToken();
} else {
    header("Location: http://localhost/vik-test/public/?service=youtube");
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
            <h1>Youtube+ Sample App</h1>       
            <?= $htmlBody; ?>
        </header>        
        <div class="box">
            <ul>
                <li>
                    <a href="http://localhost/vik-test/public/?service=gplus/get/user/people">Get User People</a>
                </li>
            </ul>
        </div>
    </body>
</html>
