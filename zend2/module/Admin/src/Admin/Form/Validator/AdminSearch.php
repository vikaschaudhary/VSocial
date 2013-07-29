<?php

namespace Admin\Form\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class AdminSearch implements InputFilterAwareInterface {

  protected $inputFilter = false;

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }

  public function getInputFilter() {

    if (!$this->inputFilter) {

      $inputFilter = new InputFilter();
      $factory = new InputFactory();


      $inputFilter->add($factory->createInput([
                  'name' => 'search_field',
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Search filed is required',
                              )
                          ),
                      ),
                  ),
      ]));

      $inputFilter->add($factory->createInput([
                  'name' => 'search_key',
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Search filed is required',
                              )
                          ),
                      ),
                  ),
      ]));
    }
    return $inputFilter;
  }

}

?>
