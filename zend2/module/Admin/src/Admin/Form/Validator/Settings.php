<?php

namespace Admin\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Settings implements InputFilterAwareInterface {

  protected $inputFilter = false;

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }

  public function getInputFilter() {

    if (!$this->inputFilter) {
      $inputFilter = new InputFilter();
      $factory = new InputFactory();

      $inputFilter->add($factory->createInput([
                  'name' => 'key',
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Setting name is required',
                              )
                          ),
                      ),
                  ),
      ]));

      $inputFilter->add(
              $factory->createInput(
                      [
                          'name' => 'value',
                          'filters' => array(
                              array('name' => 'StripTags'),
                              array('name' => 'StringTrim'),
                          ),
                          'validators' => array(
                              array(
                                  'name' => 'NotEmpty',
                                  'options' => array(
                                      'messages' => array(
                                          'isEmpty' => 'Setting values is required',
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
