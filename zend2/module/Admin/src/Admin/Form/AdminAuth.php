<?php

namespace Admin\Form;

use Zend\Form\Form;

class AdminAuth extends Form {

  public function __construct($name = null) {
    parent::__construct('');

    $this->setAttribute('method', 'post');

    $this->add(array(
        'name' => 'email',
        'type' => 'Zend\Form\Element\Email',
        'attributes' => array(
            'placeholder' => 'Email Address...',
            'required' => 'required',
        ),
        'options' => array(
            'label' => 'Email',
        ),
    ));

    $this->add(array(
        'name' => 'password',
        'type' => 'Zend\Form\Element\Password',
        'attributes' => array(
            'placeholder' => 'Password Here...',
            'required' => 'required',
        ),
        'options' => array(
            'label' => 'Password',
        ),
    ));

    $this->add(array(
        'name' => 'submit',        
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Login >>',
            'id' => 'submitbutton',
            'class' => 'login-btn',
        ),
    ));
  }

}

?>
