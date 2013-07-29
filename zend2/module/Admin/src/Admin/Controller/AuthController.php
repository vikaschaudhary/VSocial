<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Admin\Traits,
    Admin\Form,
    Admin\Model;

class AuthController extends AbstractActionController {

  use Traits\Session;

  public function indexAction() {
    $auth = Model\Authenticate::getAuthentication();
    $identity = null;

    if ($auth->hasIdentity()) {
      $identity = $auth->getIdentity();
      $sm = $this->getServiceLocator();
      $modelObj = $sm->get('Admin\Model\AdminTable');
      $adminUser = $modelObj->getUser($identity);


      $this->setAdminSession($adminUser);


      return $this->redirect()->toRoute('admin');
    } else {
      return $this->redirect()->toRoute('admin-login');
    }
  }

  public function loginAction() {

    $session = $this->getAdminSession();
    if (isset($session->admin->isLoggin) && $session->admin->isLoggin == true) {
      $this->redirect()->toRoute('admin');
    }

    $form = new Form\AdminAuth();

    $request = $this->getRequest();
    $message = null;
    if ($request->isPost()) {
      $modelObj = new Model\Admin();

      $formValidator = new Form\Validator\AdminAuth(); {
        $form->setInputFilter($formValidator->getInputFilter());
        $form->setData($request->getPost());
      }

      if ($form->isValid()) {
        $modelObj->exchangeArray($form->getData());
      }

      $post = $request->getPost();

      $sm = $this->getServiceLocator();

      $auth = new Model\Authenticate($sm);
      $result = $auth->authenticate($post);


      if ($result['success']) {
        #$this->getSessionStorage()->setRememberMe(1);
        return $this->redirect()->toRoute('admin-auth-index');
      } else {
        $message = $result['message'];
      }
    }
    return new ViewModel(array(
        'form' => $form,
        'message' => $message
            )
    );
  }

  public function logoutAction() {
    $this->getAdminSession();
    $this->destroyAdminSession();
    return $this->redirect()->toRoute('admin-login');
  }

}