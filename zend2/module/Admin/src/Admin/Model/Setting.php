<?php

namespace Admin\Model;

class Setting {

  public $id;
  public $key;
  public $value;

  public function exchangeArray($data) {
    $this->id = isset($data['setting_id']) ? (int) $data['setting_id'] : (int) false;
    $this->key = isset($data['name']) ? $data['name'] : null;
    $this->value = isset($data['value']) ? $data['value'] : null;
  }

}

?>
