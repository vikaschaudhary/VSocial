<?php

namespace NIC\Mail\Transport;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class Smtp extends SmtpTransport {

  public function __construct(SmtpOptions $options) {
    parent::setOptions($options);
  }

  public function send(Message $message) {
    parent::send($message);
  }

}

?>
