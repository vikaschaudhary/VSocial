<?php

namespace Admin\Model;

class Pages {

  public $page_id;
  public $title;
  public $owner_id;
  public $owner;
  public $description;
  public $date;
  public $content;
  public $status;
  public $keywords;

  public function exchangeArray($data) {
    $this->page_id = isset($data['page_id']) ? (int) $data['page_id'] : (int) false;
    $this->title = isset($data['page_title']) ? $data['page_title'] : null;
    $this->owner = isset($data['username']) ? $data['username'] : null;
    $this->owner_id = isset($data['page_owner']) ? (int) $data['page_owner'] : (int) false;
    $this->description = isset($data['page_description']) ? $data['page_description'] : null;
    $this->date = isset($data['page_date']) ? $data['page_date'] : null;
    $this->status = isset($data['page_status']) ? $data['page_status'] : null;
    $this->content = isset($data['page_content']) ? $data['page_content'] : null;
    $this->keywords = isset($data['page_keywords']) ? $data['page_keywords'] : null;
  }

}

?>
