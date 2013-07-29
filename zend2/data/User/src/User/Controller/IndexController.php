<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use User\Traits,
    User\Form,
    User\Model;

class IndexController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {

    #echo "<pre>";print_r($_SESSION);exit;
    /**
     * Check whether the user is login or not
     */
    $session = $this->getUserSession();
    if (!isset($session->user->isLoggin) || $session->user->isLoggin == false) {
      $this->redirect()->toRoute('user_login');
    }
//    echo "<pre>";
//    print_r($session->user);
//    exit;
    /**
     * Create request instance and route params
     */
    $request = $this->getRequest();
    $params = $this->params()->fromRoute();
    $message = null;
    /**
     * Initiate view model
     */
    $viewModel = new ViewModel();
    $viewModel->setTemplate("user/index/index");

    /**
     * Check for service locator
     */
    $sm = $this->getServiceLocator();
    /**
     * Create an instance for user model
     */
    $modelObj = $sm->get('User\Model\UserTable');
  }

}

