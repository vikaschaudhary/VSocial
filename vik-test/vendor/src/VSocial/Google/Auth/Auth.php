<?php
namespace VSocial\Google\Auth;

use VSocial\Google\IO\HttpRequest;

abstract class Auth {

    abstract public function authenticate ($service);

    abstract public function sign (HttpRequest $request);

    abstract public function createAuthUrl ($scope);

    abstract public function getAccessToken ();

    abstract public function setAccessToken ($accessToken);

    abstract public function setDeveloperKey ($developerKey);

    abstract public function refreshToken ($refreshToken);

    abstract public function revokeToken ();
}
