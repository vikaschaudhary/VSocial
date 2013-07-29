<?php
require_once 'twitter/validation.php';

$twitter_options = array(
    "account" => array(
        array("url" => "account/verify_credentials", "method" => "GET",),
        array("url" => "account/settings", "method" => "GET",),
        array("url" => "account/settings", "method" => "POST",),
        array("url" => "account/update_delivery_device", "method" => "POST",),
        array("url" => "account/update_profile", "method" => "POST",),
        array("url" => "account/update_profile_background_image", "method" => "POST",),
        array("url" => "account/update_profile_banner", "method" => "POST",),
        array("url" => "account/remove_profile_banner", "method" => "POST",),
        array("url" => "account/update_profile_colors", "method" => "POST",),
        array("url" => "account/update_profile_image", "method" => "POST",),
    ),
    "users" => array(
        array("url" => "users/profile_banner", "method" => "GET",),
        array("url" => "users/contributees", "method" => "GET",),
        array("url" => "users/contributors", "method" => "GET",),
        array("url" => "users/search", "method" => "GET",),
        array("url" => "users/show", "method" => "GET",),
        array("url" => "users/lookup", "method" => "GET",),
    ),
    "blocks" => array(
        array("url" => "blocks/ids", "method" => "GET",),
        array("url" => "blocks/list", "method" => "GET",),
        array("url" => "blocks/destroy", "method" => "POST",),
        array("url" => "blocks/create", "method" => "POST",),
    ),
    "statuses" => array(
        array("url" => "statuses/home_timeline", "method" => "GET",),
        array("url" => "statuses/mentions_timeline", "method" => "GET",),
        array("url" => "statuses/retweets", "method" => "GET",),
        array("url" => "statuses/retweets_of_me", "method" => "GET",),
        array("url" => "statuses/user_timeline", "method" => "GET",),
        array("url" => "statuses/show", "method" => "GET",),
        array("url" => "statuses/retweeters", "method" => "GET",),
        array("url" => "statuses/sample", "method" => "GET",),
        array("url" => "statuses/firehose", "method" => "GET",),
        array("url" => "statuses/update_with_media", "method" => "POST",),
        array("url" => "statuses/retweet", "method" => "POST",),
        array("url" => "statuses/update", "method" => "POST",),
        array("url" => "statuses/destroy", "method" => "POST",),
        array("url" => "statuses/filter", "method" => "POST",),
    ),
    "search" => array(
        array("url" => "search/tweets", "method" => "GET",),
    ),
    '' => array(
        array("url" => "user", "method" => "GET",),
        array("url" => "site", "method" => "GET",),
    ),
    'direct' => array(
        array("url" => "direct/messages", "method" => "GET",),
        array("url" => "direct/messages_sent", "method" => "GET",),
        array("url" => "direct/messages_show", "method" => "GET",),
        array("url" => "direct/messages_destroy", "method" => "POST",),
        array("url" => "direct/messages_new", "method" => "POST",),
    ),
);
?>
<?php
$options_uris = array();
foreach ($twitter_options as $key => $options):
    foreach ($options as $option):
        if (is_array($option)) {
            $method = strtolower($option['method']);
            $key = $option['url'];
            $uri = "{$method}/{$key}";
            $mehtod_title = ucwords(str_replace("/", " ", $option['url']));
            $mehtod_title = ucfirst($method) . ' ' . ucwords(str_replace("_", " ", $mehtod_title));
            $options_uris[] = array("method" => $method, "title" => $mehtod_title, "url" => $uri);
        }
    endforeach;
endforeach;
sort($options_uris);
?>
<ol style="list-style-type: symbols; margin:5px; padding:10px;">
    <?php foreach ($options_uris as $opt): ?>
        <li>
            <a class="<?= $opt['method'] ?>" target="_blank" href="http://10.2.2.82/vik-test/public/index.php?service=twitter/<?= $opt['url'] ?>"><?= $opt['title'] ?></a>    
        </li>
    <?php endforeach; ?>
</ol>
<style type="text/css">
    pre{line-height: 8px;}
</style>