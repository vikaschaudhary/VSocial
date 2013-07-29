<?php

namespace Admin\Traits;

use Zend\Session\Container;

trait Session {

  protected $sessionManager = null;

  public function setSession() {
    $sm = $this->getServiceLocator();
    $this->sessionManager = $sm->get('Zend\Session\SessionManager');
  }

  public function getAdminSession() {
    if ($this->sessionManager == null) {
      $this->setSession();
    }
    $adminSession = new Container("admin");
    return $adminSession;
  }

  public function setAdminSession($data) {
    $adminSession = new Container("admin");
    $adminSession->admin = $data;
    $adminSession->admin->isLoggin = true;
  }

  public function destroyAdminSession() {
    $this->sessionManager->destroy();
  }

}

?>
