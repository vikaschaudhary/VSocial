<?php

namespace Application\Options\OptionInterface;

interface AuthOptionsInterface {

  /**
   * set login form timeout in seconds
   *
   * @param int $loginFormTimeout
   */
  public function setLoginFormTimeout($loginFormTimeout);

  /**
   * set login form timeout in seconds
   *
   * @param int $loginFormTimeout
   */
  public function getLoginFormTimeout();

  /**
   * set auth identity fields
   *
   * @param array $authIdentityFields
   * @return ModuleOptions
   */
  public function setAuthIdentityFields($authIdentityFields);

  /**
   * get auth identity fields
   *
   * @return array
   */
  public function getAuthIdentityFields();

  /**
   * set password cost
   *
   * @param int $passwordCost
   * @return ModuleOptions
   */
  public function setPasswordCost($cost);

  /**
   * get password cost
   *
   * @return int
   */
  public function getPasswordCost();
}
