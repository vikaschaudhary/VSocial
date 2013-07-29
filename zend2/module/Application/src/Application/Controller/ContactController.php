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
use Application\Form\Contact as ContactForm,
    Application\Form\ContactValidator;

class ContactController extends AbstractActionController {

  public function indexAction() {
    $form = new ContactForm();
    $request = $this->getRequest();
    
    if ($request->isPost()) {
      $user = new ContactModel();

      $formValidator = new ContactValidator();
      {
        $form->setInputFilter($formValidator->getInputFilter());
        $form->setData($request->getPost());
      }

      if ($form->isValid()) { {
          $user->exchangeArray($form->getData());
        }
      }
    }
    return new ViewModel(array('form' => $form));
  }

}

