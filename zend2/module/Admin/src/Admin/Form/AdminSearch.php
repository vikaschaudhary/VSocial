<?php

namespace Admin\Form;

use Zend\Form\Form;

class AdminSearch extends Form {

  public function __construct($name = null, $options = array(), $route) {
    parent::__construct('');

    $this->setAttribute('method', 'post');
    $this->setAttribute('action', '');
    $this->setAttribute('id', 'admin-serch-form');
    $this->setAttribute('name', 'admin-serch-form');


    $this->add(array(
        'name' => 'search_key',
        'type' => 'Zend\Form\Element\Text',
        'attributes' => array(
            'placeholder' => 'Search users...',
            'required' => 'required',
        ),
        'options' => array(
            'label' => 'Search Keyword',
        ),
    ));


    $this->add(array(
        'name' => 'search_field',
        'type' => 'Zend\Form\Element\Select',
        'attributes' => array(
            'required' => 'required',
        ),
        'options' => array(
            'label' => 'Select Column',
            'value_options' => $options,
        )
    ));

    $this->add(array(
        'name' => 'search-btn',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Search',
            'id' => 'search-btn',
            'class' => 'srch-btn',
        ),
    ));

    $this->add(array(
        'name' => 'reset-btn',
        'attributes' => array(
            'type' => 'button',
            'value' => 'Reset',
            'id' => 'search-btn',
            'class' => 'reset-btn',
            'onclick' => "window.location.href='/{$route}'"
        ),
    ));
  }

}

?>
