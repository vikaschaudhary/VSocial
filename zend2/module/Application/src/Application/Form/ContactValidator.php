<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ContactValidator implements InputFilterAwareInterface {

  protected $inputFilter;

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }

  public function getInputFilter() {
    if (!$this->inputFilter) {
      $inputFilter = new InputFilter();
      $factory = new InputFactory();


      $inputFilter->add($factory->createInput([
                  'name' => 'text',
                  'required' => 0,
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                  ),
      ]));

      $inputFilter->add($factory->createInput([
                  'name' => 'email',
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'EmailAddress',
                          'options' => array(
                              'messages' => array(
                                  'emailAddressInvalidFormat' => 'Email address is not invalid',
                              )
                          ),
                      ),
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Email address is required',
                              )
                          ),
                      ),
                  ),
      ]));

      $inputFilter->add($factory->createInput([
                  'name' => '',
                  'required' => true,
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                  ),
      ]));
    }
  }

}

?>