<?php

namespace Application\Options;

use Zend\Stdlib\AbstractOptions;
use Application\Options\OptionInterface\ControllerOptionsInterface;
use Application\Options\OptionInterface\ServiceOptionsInterface;

class ModuleOptions extends AbstractOptions implements ControllerOptionsInterface, ServiceOptionsInterface {

  protected $useRedirect = false;
  protected $entityClass;

  public function setUseRedirect($useRedirect) {
    if (null !== $useRedirect) {
      $this->useRedirect = (bool) $useRedirect;
    }

    return $this;
  }

  public function getUseRedirect() {
    return $this->useRedirect;
  }

  public function setEntityClass($entityClass) {
    if (null !== $entityClass) {
      $this->entityClass = $entityClass;
    }
    return $this;
  }

  public function getEntityClass() {
    return $this->entityClass;
  }

}

?>
