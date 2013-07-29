<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Admin\Traits;

class ListingController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $session = $this->getAdminSession();
    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }
  }

}