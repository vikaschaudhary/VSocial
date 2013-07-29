<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class UserController extends AbstractActionController {

  public function indexAction() {
    $viewModel = new ViewModel();
    $viewModel->setTemplate('application/user/index');
  }

  public function signupAction() {
    /**
     * @todo Check already login or not validation
     */
    /**
     * Init View Model and set vew template
     */
    $viewModel = new ViewModel();
    $viewModel->setTemplate('application/user/signup');

    /**
     * Init Request and route params Vars
     */
    $request = $this->getRequest();
    $route_params = $this->params()->fromRoute();

    /**
     * Return view
     */
    return $viewModel->setVariables(array());
  }

}

