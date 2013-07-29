<?php

$authSession = $_SESSION['twitter_session'];
if (empty($authSession) || empty($authSession['oauth_token']) || empty($authSession['oauth_token_secret'])) {
    header("Location: http://10.2.2.82/vik-test/public/?service=twitter");
}
?>
