<?php
$fb_options = array(
    "users" => array(
        array("url" => "users/profile", "method" => "GET",),
        array("url" => "users/connections", "method" => "GET",),
        array("url" => "users/updates", "method" => "GET",),
    ),
);
?>
<?php
$options_uris = array();
foreach ($fb_options as $key => $options):
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
            <a class="<?= $opt['method'] ?>" target="_blank" href="http://10.2.2.82/vik-test/public/index.php?service=linkedin/<?= $opt['url'] ?>"><?= $opt['title'] ?></a>    
        </li>
    <?php endforeach; ?>
</ol>
<style type="text/css">
    pre{line-height: 8px;}
</style>