<?php

namespace Application\Model;

class Contact {

  protected $name;
  protected $email;
  protected $phone;
  protected $message;

  public function exchangeArray($data) {
    $this->name = (!empty($data['name'])) ? $data['name'] : null;
    $this->email = (!empty($data['email'])) ? $data['email'] : null;
    $this->phone = (!empty($data['phone'])) ? $data['phone'] : null;
    $this->message = (!empty($data['message'])) ? $data['message'] : null;
  }

}

?>