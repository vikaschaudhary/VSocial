<?php

namespace NIC\Mail\Transport;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class Sendmail extends SendmailTransport {

  public function __construct($parameters = null) {
    parent::__construct($parameters);
  }

  public function send(Message $message) {
    parent::send($message);
  }

}

?>
