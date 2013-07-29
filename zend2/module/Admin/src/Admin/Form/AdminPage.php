<?php

namespace Admin\Form;

use Zend\Form\Form;

class AdminPage extends Form {

  public function __construct($name = null) {
    parent::__construct('');

    $this->setAttribute('method', 'post');
    $i = 0;
    $this->add(array(
        'name' => 'title',
        'type' => 'Zend\Form\Element\Text',
        'attributes' => array(
            'placeholder' => 'Page Title...',
            'required' => 'required',
            'class' => 'width6px',
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Title',
        ),
    ));

    $this->add(array(
        'name' => 'description',
        'type' => 'Zend\Form\Element\Textarea',
        'attributes' => array(
            'placeholder' => 'Page Description....',
            'required' => 'required',
            'rows' => 10,
            'cols' => 30,
            'class' => 'width62px',
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Description',
        ),
    ));
    $this->add(array(
        'name' => 'content',
        'type' => 'Zend\Form\Element\Textarea',
        'attributes' => array(
            'placeholder' => 'Page Content....',
            'required' => 'required',
            'rows' => 5,
            'cols' => 15,
            'id' => "page_content",
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Content',
        ),
    ));

    $this->add(array(
        'name' => 'keywords',
        'type' => 'Zend\Form\Element\Text',
        'attributes' => array(
            'placeholder' => 'Page Keywords...',
            'required' => 'required',
            'class' => 'width6px',
            'tabindex' => ++$i
        ),
        'options' => array(
            'label' => 'Keywords',
        ),
    ));
    $this->add(array(
        'name' => 'save_publish',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Save & Publish',
            'id' => 'submitbutton',
            'class' => 'login-btn',
            'tabindex' => ++$i
        ),
    ));
    $this->add(array(
        'name' => 'save_draft',
        'attributes' => array(
            'type' => 'submit',
            'value' => 'Save as Draft',
            'id' => 'submitbutton',
            'class' => 'login-btn clearnone',
            'tabindex' => ++$i
        ),
    ));
  }

}

?>
