<?php

namespace Application\Options\OptionInterface;

interface SignupOptionsInterface {

  /**
   * set enable display name
   *
   * @param bool $flag
   * @return ModuleOptions
   */
  public function setEnableDisplayName($enableDisplayName);

  /**
   * get enable display name
   *
   * @return bool
   */
  public function getEnableDisplayName();

  /**
   * set enable user registration
   *
   * @param bool $enableRegistration
   */
  public function setEnableSignup($enableSignup);

  /**
   * get enable user registration
   *
   * @return bool
   */
  public function getEnableSignup();

  /**
   * set enable username
   *
   * @param bool $flag
   * @return ModuleOptions
   */
  public function setEnableUsername($enableUsername);

  /**
   * get enable username
   *
   * @return bool
   */
  public function getEnableUsername();

  /**
   * set user form timeout in seconds
   *
   * @param int $userFormTimeout
   */
  public function setFormTimeout($userFormTimeout);

  /**
   * get user form timeout in seconds
   *
   * @return int
   */
  public function getFormTimeout();

  /**
   * set use a captcha in registration form
   *
   * @param bool $useRegistrationFormCaptcha
   * @return ModuleOptions
   */
  public function setcSignupCaptcha($useSignupCaptcha);

  /**
   * get use a captcha in registration form
   *
   * @return bool
   */
  public function getcSignupCaptcha();

  /**
   * set login after registration
   *
   * @param bool $loginAfterRegistration
   * @return ModuleOptions
   */
  public function setLoginAfterSignup($loginAfterSignup);

  /**
   * get login after registration
   *
   * @return bool
   */
  public function getLoginAfterSignup();

  /**
   * set form CAPTCHA options
   *
   * @param array $formCaptchaOptions
   * @return ModuleOptions
   */
  public function setCaptchaOptions($captchaOptions);

  /**
   * get form CAPTCHA options
   *
   * @return array
   */
  public function getCaptchaOptions();
}
