<?php

use VSocial\Google\Client;
use VSocial\Google\Api;
#echo "<pre>"; echo date("d M Y",strtotime('2013-07-26T12:25:31.474Z'));exit;
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
#$me_id = isset($me['id']) && !empty($me['id']) ? $me['id'] : $user_id;
#$people = $plus->people->listPeople($me_id, 'visible');
    $optParams = array('maxResults' => 100);
    $activities = $plus->activities->listActivities($user_id, 'public', $optParams);
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
            <?php if (isset($activities['items']) && sizeof($activities['items']) > 0): ?>
                <div class="activities">
                    <h3><?= $activities['title'] ?></h3> 
                    <div class="clearfix"></div>

                    <?php
                    $even_li = $odd_li = '';
                    foreach ($activities['items'] as $key => $val) {
                        if (($key) % 2 == 0) {
                            $even_li .= html($key, $val);
                        } else {
                            $odd_li .= html($key, $val);
                        }
                    }
                    ?>
                    <ul class="activity odd">
                        <?= $odd_li ?>
                    </ul>
                    <ul class="activity even">
                        <?= $even_li ?>
                    </ul>
                </div>
            <?php endif ?>
        </div>
    </body>
</html>
<?php

function getUserActivity ($val) {
    $activityObject = $val['object'];
    $activity_url = $activityObject['url'];
    $display_text = (isset($activityObject['content']) && !empty($activityObject['content'])) ?
            $activityObject['content'] : $val['title'];
    $activity_attachments = isset($activityObject['attachments']) ? $activityObject['attachments'] : array();
    $displayName = $image = "";
    if (sizeof($activity_attachments) > 0) {

        foreach ($activity_attachments as $attachment) {
            $displayName = null;
            if (isset($attachment['image'])) {
                $image_url = $attachment['image']['url'];
                $height = $attachment['image']['height'];
                $width = $attachment['image']['width'];
                $image .= <<<IMAGE
        <div class="attachment-image">
            <img src="{$image_url}" />
        </div>
IMAGE;
                $display_text = isset($attachment['displayName']) ? $attachment['displayName'] : $display_text;
                $displayName .= <<<DISPLAYNAME
                <div class="attachment-name">
                    <a href="{$attachment['url']}">
                        <span>{$display_text}</span>
                    </a>
                    <div class="attachment-link">
                        <a class="in-anchor" target="_blank" href="{$attachment['url']}">
                            {$attachment['url']}
                        </a>
                    </div>
                </div>
DISPLAYNAME;
            } elseif (isset($attachment['thumbnails']) && sizeof(isset($attachment['thumbnails'])) > 0) {
                $thumbnails = "";
                foreach ($attachment['thumbnails'] as $key => $thumbnail) {
                    if ($key < 4) {
                        $image_url = $thumbnail['image']['url'];
                        $thumbnails .= "
            <div class='info-wrap'>
                <a href='{$image_url}'>
                    <img src='{$image_url}' />
                </a>
            </div>
         ";
                    }
                }
                $image .= <<<IMAGE
                <div class="thumb_wrap">
                     <div class="thumb-title">
                         <div class="t-h"></div>
                         <div class="title-tag">
                             <a href="{$attachment['url']}" class="XCijsb">
                                 {$attachment['displayName']}
                              </a>
                         </div>                                                                    
                     </div>
                     <div class="nNIfo">
                         {$thumbnails}
                     </div>                                                    
                 </div> 
IMAGE;
            }
        }
    } else {
        $displayName = <<<DISPLAYNAME
                <div class="attachment-name">
                    <a href="{$activityObject['url']}">
                        <span>{$display_text}</span>
                    </a>
                    <!--<div class="attachment-link">
                        <a class="in-anchor" target="_blank" href="{$activityObject['url']}">
                            {$activityObject['url']}
                        </a>
                    </div>-->
                </div>
DISPLAYNAME;
    }

    $attachments = <<<ATTACHMENT
 <div class="attachment">
        {$image}
        {$displayName}
         <div class="clearfix"></div>
</div>
ATTACHMENT;

    return $attachments;
}

function html ($key, $val) {
    $published_date = date("d M Y",strtotime($val['published']));        
    $userActivity = getUserActivity($val);
    $i = $key + 1;
    $html = <<<HTML
            
<li class = "sb" id = "activity-{$i}">
            <div class = "activity-user">
                <div class = "activity-user-head">
                    <a class = "actor-img" href = "{$val['actor']['url']}">
                        <img width = "46px" height = "46px" class = "" alt = "" src = "{$val['actor']['image']['url']}" />
                    </a>
                    <div class = "actor-head">
                        <header class = "actor-head">
                            <h3 class = "cK">
                                <a class = "head-t" href = "{$val['actor']['url']}">
                                    {$val['actor']['displayName']}
                                </a>
                            </h3>
                            <span class="feed-det">
                                <span aria-haspopup="true" tabindex="0" title="Sharing details" class="a-n ej Ku pl B5" role="button">
                                    Shared publicly
                                </span> &nbsp;-&nbsp; 
                                <span class="Ri lu">
                                    <a title="8 May 2013 14:06:46" class="g-M-n ik Bf" target="_blank" href="107904937203680484166/posts/T9weLDFnPaT">
                                        {$published_date}
                                    </a>
                                </span>
                            </span> 
                        </header>
                    </div>
                </div>                                    
            </div>
            <div class="clearfix"></div>
            <div class="user-activity">
              {$userActivity}
            </div>
            <div class="clearfix"></div>
        </li>        
HTML;
    return $html;
}
?>