<?php

namespace Admin\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Session\Container;

class AdminSession extends AbstractHelper {

  protected $_session;
  protected $_key = "admin";

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
