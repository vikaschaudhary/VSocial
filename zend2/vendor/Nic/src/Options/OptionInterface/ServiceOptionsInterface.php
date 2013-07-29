<?php

namespace Application\Options\OptionInterface;

use Application\Options\OptionInterface\SignupOptionsInterface;
use Application\Options\OptionInterface\AuthOptionsInterface;

interface ServiceOptionsInterface extends SignupOptionsInterface, AuthOptionsInterface {

  /**
   * set user entity class name
   *
   * @param string $entityClass
   * @return ModuleOptions
   */
  public function setEntityClass($entityClass);

  /**
   * get user entity class name
   *
   * @return string
   */
  public function getEntityClass();
}
