<?php

namespace Application\Form;

use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;

class Contact extends Form {

  public function __construct($name = null) {
    parent::__construct('form1');

    $this->setAttribute('method', 'post');
    $tabIndex = 0;
    /**
     * Username
     */
    $this->add(array(
        'name' => 'username',
        'type' => 'Zend\Form\Element\Text',
        'label' => 'Username',
        'attributes' => array(
            'id' => 'username',
            'placeholder' => 'Username:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Email Address
     */
    $this->add(array(
        'name' => 'email',
        'type' => 'Zend\Form\Element\Email',
        'label' => 'Email Address',
        'attributes' => array(
            'id' => 'email',
            'placeholder' => 'E-mail Address:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Password
     */
    $this->add(array(
        'name' => 'password',
        'type' => 'Zend\Form\Element\Password',
        'label' => 'Password',
        'attributes' => array(
            'id' => 'password',
            'placeholder' => 'Password:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Confirm Password
     */
    $this->add(array(
        'name' => 'password_conf',
        'type' => 'Zend\Form\Element\Password',
        'label' => 'Confirm Password',
        'attributes' => array(
            'id' => 'password_conf',
            'placeholder' => 'Confirm Password:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * First Name
     */
    $this->add(array(
        'name' => 'first_name',
        'type' => 'Zend\Form\Element\Text',
        'label' => 'First Name',
        'attributes' => array(
            'id' => 'first_name',
            'placeholder' => 'First Name:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Last Name
     */
    $this->add(array(
        'name' => 'last_name',
        'type' => 'Zend\Form\Element\Text',
        'label' => 'Last Name',
        'attributes' => array(
            'id' => 'last_name',
            'placeholder' => 'Last Name:',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));

    /**
     * Date of birth
     */
    $this->add(array(
        'name' => 'birth_date',
        'type' => 'Zend\Form\Element\Text',
        'label' => 'Date of Birth',
        'attributes' => array(
            'id' => 'birth_date',
            'placeholder' => '1987-05-01',
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Gender
     */
    $this->add(array(
        'type' => 'Zend\Form\Element\Radio',
        'name' => 'gender',
        'label' => 'Gender ?',
        'options' => array(
            'value_options' => array(
                'male' => 'Male',
                'female' => 'Female',
            ),
            "tabindex" => ++$tabIndex,
        )
    ));
    /**
     * Address
     */
    $this->add(array(
        'name' => 'address',
        'type' => 'Zend\Form\Element\Textarea',
        'label' => 'Address',
        'attributes' => array(
            'id' => 'address',
            'placeholder' => 'Address',
            'rows' => 5,
            'cols' => 30,
            'required' => 'required',
        ),
        'options' => array(
            "tabindex" => ++$tabIndex,
        ),
    ));
    /**
     * Profile Image
     */
    
    /**
     * Submit Button
     */
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