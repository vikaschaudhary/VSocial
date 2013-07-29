<?php

namespace User\Form;

use Zend\Form\Form;

class Auth extends Form {

  public function __construct($name = null) {
    parent::__construct($name);

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
        'type' => 'Zend\Form\Element\Checkbox',
        'name' => 'remember_me',
        'options' => array(
            'use_hidden_element' => true,
            'checked_value' => (int) true,
            'unchecked_value' => (int) false
        )
    ));

    $this->add(array(
        'name' => 'submit_login',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Login >>',
            'id' => 'submit_login',
            'class' => 'pro_btn fleft',
        ),
    ));
  }

}

?>
