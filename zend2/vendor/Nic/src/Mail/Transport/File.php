<?php

namespace NIC\Mail\Transport;

use Zend\Mail\Message;
use Zend\Mail\Transport\File as FileTransport;
use Zend\Mail\Transport\FileOptions;

class File extends FileTransport {

  public function __construct(SmtpOptions $options) {
    parent::setOptions($options);
  }

  public function send(Message $message) {
    parent::send($message);
  }

}

?>
