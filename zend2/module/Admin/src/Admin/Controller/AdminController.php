<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Admin\Traits;

class AdminController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('admin/pages/index');


    $session = $this->getAdminSession();

    if (!isset($session->admin->isLoggin) || $session->admin->isLoggin == false) {
      $this->redirect()->toRoute('admin-login');
    }

    $sm = $this->getServiceLocator();
    $modelObj = $sm->get('Admin\Model\PageTable');
    $params = $this->params()->fromRoute();
  }

}