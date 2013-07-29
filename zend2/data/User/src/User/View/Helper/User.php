<?php

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper,
    Zend\ServiceManager\ServiceLocatorInterface;

class User extends AbstractHelper {

  protected $locator;
  protected $_session;
  protected $_key = "user";

  public function __construct(ServiceLocatorInterface $locator) {
    $this->locator = $locator;
  }

  public function getUser($user_id = false) {
    $modelObj = $this->locator->get('User\Model\UserTable');
    if (!$user_id && isset($this->_session->user_id)) {
      $id = $this->_session->user_id;
    } else {
      $id = $user_id;
    }

    return $modelObj->fetch_user_data($id);
  }

}

?>
