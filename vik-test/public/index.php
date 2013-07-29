<style type="text/css">
    body{width:1024px; margin:5px; padding:5px 50px;}
    a{color: #128040;}
    a.post{color:#c30803}
    a.get{color:#128040}
    pre{
        margin: 0px;
        padding: 15px 50px;
        line-height: 15px;
        background: #d5cece;
    }
</style>
<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
}

$service = isset($_REQUEST['service']) ? $_REQUEST['service'] : 'gplus';
$service_script = getcwd() . DIRECTORY_SEPARATOR . $service . '.php';

if (file_exists($service_script)) {

    if (session_id() == '') {
        session_start();
    }
    #echo "<pre>";
    require_once $service_script;
    #echo "</pre>";
}