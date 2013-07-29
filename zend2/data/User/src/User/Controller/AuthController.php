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
    User\Model,
    User\Form;

class AuthController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {

//    $sm = $this->getServiceLocator();
//    $modelObj = $sm->get('User\Model\UserTable');
//
//    $params = $this->params()->fromRoute();
  }

  public function loginAction() {
    /**
     * Check if already login
     */
    $session = $this->getUserSession();
    if (isset($session->user->isLoggin) && $session->user->isLoggin == true) {
      $this->redirect()->toRoute('user_home');
    }
    /**
     * Create request instance
     */
    $request = $this->getRequest();
    $message = null;
    /**
     * Initiate view model
     */
    $viewModel = new ViewModel();
    /**
     * Set Layout
     */
    $this->layout('layout/login');

    /**
     * Check for service locator
     */
    $sm = $this->getServiceLocator();
    /**
     * Create an instance for user model
     */
    $modelObj = $sm->get('User\Model\UserTable');

    /**
     * Create form instance
     */
    $form = new Form\Auth();

    /**
     * Handle login form request if request type is post
     */
    if ($request->isPost()) {

      /**
       * Create instance for auth form validator
       */
      $formValidator = new Form\Validator\Auth();
      /**
       * Process form validation
       */
      $form->setInputFilter($formValidator->getInputFilter());
      $form->setData($request->getPost());

      /**
       * Check whether the form values is valid or not
       */
      if ($form->isValid()) {
        $modelObj->exchangeArray($form->getData());
      }
      /**
       * Get Form values
       */
      $post = $request->getPost();
      /**
       * Start login authentication
       */
      $auth = new Model\Authenticate($sm);
      $result = $auth->authenticate($post);
      if ($result['success']) {
        #$this->getSessionStorage()->setRememberMe(1);
        /**
         * Create user session if user is authenticated successfully
         */
        $authenticate = Model\Authenticate::getAuthentication();
        if ($authenticate->hasIdentity()) {
          $identity = $authenticate->getIdentity();
          $user = $modelObj->getUser($identity);
          $this->setUserSession($user);
          /**
           * Redirect to user's home page
           */
          return $this->redirect()->toRoute('user_home');
        }
      } else {
        $message = $result['message'];
      }
    }
    /**
     * Set the view variables
     */
    return $viewModel->setVariables(array(
                'form' => $form,
                'message' => $message
                    )
    );
  }

}
