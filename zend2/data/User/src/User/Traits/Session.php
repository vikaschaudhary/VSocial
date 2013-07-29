<?php

namespace User\Traits;

use Zend\Session\Container;

trait Session {

  protected $sessionManager = null;

  public function setSession() {
    $sm = $this->getServiceLocator();
    $this->sessionManager = $sm->get('Zend\Session\SessionManager');
  }

  public function getUserSession() {
    if ($this->sessionManager == null) {
      $this->setSession();
    }
    $userSession = new Container("user");
    return $userSession;
  }

  public function setUserSession($data) {
    $userSession = new Container("user");
    $userSession->user = $data;
    $userSession->user->isLoggin = true;
  }

  public function destroyUserSession() {
    $this->sessionManager->destroy();
  }

}

?>
