<?php

namespace Admin\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AdminPage implements InputFilterAwareInterface {

  protected $inputFilter = false;

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }

  public function getInputFilter() {

    if (!$this->inputFilter) {
      $inputFilter = new InputFilter();
      $factory = new InputFactory();

      $inputFilter->add($factory->createInput([
                  'name' => 'title',
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Title is required',
                              )
                          ),
                      ),
                  ),
      ]));

      $inputFilter->add(
              $factory->createInput(
                      [
                          'name' => 'description',
                          'filters' => array(
                              array('name' => 'StripTags'),
                              array('name' => 'StringTrim'),
                          ),
                          'validators' => array(
                              array(
                                  'name' => 'NotEmpty',
                                  'options' => array(
                                      'messages' => array(
                                          'isEmpty' => 'Description is required',
                                      )
                                  ),
                              ),
                          ),
                      ]
              )
      );

      $inputFilter->add(
              $factory->createInput(
                      [
                          'name' => 'content',
                          'filters' => array(
                              array('name' => 'StripTags'),
                              array('name' => 'StringTrim'),
                          ),
                          'validators' => array(
                              array(
                                  'name' => 'NotEmpty',
                                  'options' => array(
                                      'messages' => array(
                                          'isEmpty' => 'Content is required',
                                      )
                                  ),
                              ),
                          ),
                      ]
              )
      );
      $inputFilter->add(
              $factory->createInput(
                      [
                          'name' => 'keywords',
                          'filters' => array(
                              array('name' => 'StripTags'),
                              array('name' => 'StringTrim'),
                          ),
                          'validators' => array(
                              array(
                                  'name' => 'NotEmpty',
                                  'options' => array(
                                      'messages' => array(
                                          'isEmpty' => 'Keywords is required',
                                      )
                                  ),
                              ),
                          ),
                      ]
              )
      );

      return $inputFilter;
    }
  }

}

?>
