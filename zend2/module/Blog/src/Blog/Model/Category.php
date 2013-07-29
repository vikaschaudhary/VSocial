<?php

namespace Blog\Model;

class Category {

  public $category_id;
  public $title;
  public $status;
  public $count;

  public function exchangeArray($data) {
    $this->category_id = (!empty($data['category_id'])) ? $data['category_id'] : null;
    $this->title = (!empty($data['category_title'])) ? $data['category_title'] : null;
    $this->status = ($data['status']) ? $data['status'] : null;
    $this->count = ($data['count']) ? $data['count'] : 0;
  }

}

?>
