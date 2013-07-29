<?php

namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class RegisterValidator implements InputFilterAwareInterface {

  protected $inputFilter;

  public function setInputFilter(InputFilterInterface $inputFilter) {
    throw new \Exception("Not used");
  }

  public function getInputFilter() {
    if (!$this->inputFilter) {
      $inputFilter = new InputFilter();
      $factory = new InputFactory();
      /**
       * Username
       */
      $inputFilter->add($factory->createInput([
                  'name' => 'username',
                  'required' => true,
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'Username is required',
                              )
                          ),
                      ),
                  ),
      ]));
      /**
       * First Name
       */
      $inputFilter->add($factory->createInput([
                  'name' => 'first_name',
                  'required' => true,
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(
                      array(
                          'name' => 'NotEmpty',
                          'options' => array(
                              'messages' => array(
                                  'isEmpty' => 'First Name is required',
                              )
                          ),
                      ),
                  ),
      ]));

      /**
       * Last Name
       */
      $inputFilter->add($factory->createInput([
                  'name' => 'last_name',
                  'required' => false,
                  'filters' => array(
                      array('name' => 'StripTags'),
                      array('name' => 'StringTrim'),
                  ),
                  'validators' => array(),
      ]));

      /**
       * Email Address
       */
      $inputFilter->add($factory->createInput([
                  'name' => 'email',
                  'required' => true,
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
    }
  }

}

?>