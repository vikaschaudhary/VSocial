<?php

namespace Admin\Form;

use Zend\Form\Form;

class Settings extends Form {

  public function __construct($name = null) {
    parent::__construct('');

    $this->setAttribute('method', 'post');
    $i = 0;
    $this->add(array(
        'name' => 'key',
        'type' => 'Zend\Form\Element\Text',
        'attributes' => array(
            'placeholder' => 'Setting Key...',
            'required' => 'required',
            'disabled' => 'disabled',
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Title',
        ),
    ));

    $this->add(array(
        'name' => 'value',
        'type' => 'Zend\Form\Element\Textarea',
        'attributes' => array(
            'placeholder' => 'Setting Value....',
            'required' => 'required',
            'rows' => 10,
            'cols' => 30,
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Value',
        ),
    ));

    $this->add(array(
        'name' => 'save_settings',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Save ',
            'id' => 'submitbutton',
            'class' => 'login-btn',
            'tabindex' => ++$i
        ),
    ));
  }

}

?>
