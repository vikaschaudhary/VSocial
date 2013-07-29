<?php

namespace Application\Options\OptionInterface;

interface ControllerOptionsInterface {

  /**
   * set use redirect param if present
   *
   * @param bool $useRedirectParameterIfPresent
   */
  public function setUseRedirect($useRedirect);

  /**
   * get use redirect param if present
   *
   * @return bool
   */
  public function getUseRedirect();
}
