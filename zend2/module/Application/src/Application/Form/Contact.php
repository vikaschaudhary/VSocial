<?php

namespace Application\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class Contact extends Form {

  public function __construct($name = null) {
    parent::__construct('form1');

    $this->setAttribute('method', 'post');

    $this->add(array(
        'name' => 'name',
        'type' => 'Zend\Form\Element\Text',
        'attributes' => array(
            'id' => 'contactName',
            'placeholder' => 'Name:',
            'required' => 'required',
        ),
        'options' => array(),
    ));

    $this->add(array(
        'name' => 'email',
        'type' => 'Zend\Form\Element\Email',
        'attributes' => array(
            'id' => 'email',
            'placeholder' => 'E-mail:',
            'required' => 'required',
        ),
        'options' => array(),
    ));
    $this->add(array(
        'name' => 'phone',
        'type' => 'Zend\Form\Element\Tel',
        'attributes' => array(
            'id' => 'phone',
            'placeholder' => 'Phone:',
            'required' => 'required',
        ),
        'options' => array(),
    ));

    $this->add(array(
        'name' => 'message',
        'type' => 'Zend\Form\Element\Textarea',
        'attributes' => array(
            'id' => 'message',
            'placeholder' => 'Message:',
            'required' => 'required',
        ),
        'options' => array(),
    ));

//    $this->add(array(
//        'name' => 'csrf',
//        'type' => 'Zend\Form\Element\Csrf',
//    ));
    $this->add(array(
        'name' => 'submit',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Submit',
            'id' => 'submitbutton',
        ),
    ));
  }

}

?>