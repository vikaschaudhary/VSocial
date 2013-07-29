<?php

namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class Session extends AbstractHelper {

  protected $_session;
  protected $_key = "user";

  public function __construct($key = null) {
    if (!is_null($key)) {
      $this->_key = $key;
    }
    $this->_session = new Container($this->_key);
  }

  public function getSession() {
    return $this->_session;
  }

}

?>
