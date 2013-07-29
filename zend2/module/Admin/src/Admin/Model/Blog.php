<?php

namespace Admin\Model;

class Blog {

  public $blog_id;
  public $category_id;
  public $author_id;
  public $blog_title;
  public $description;
  public $blog_date;
  public $last_update_date;
  public $is_archive;
  public $is_draft;
  public $is_publish;
  public $total_comments;
  public $author;
  public $category;

  public function exchangeArray($data) {
    $this->blog_id = isset($data['blog_id']) ? $data['blog_id'] : (int) false;
    $this->category_id = isset($data['user_email']) ? $data['user_email'] : (int) false;
    $this->author_id = isset($data['author_id']) ? (int) $data['author_id'] : (int) false;
    $this->blog_title = isset($data['blog_title']) ? $data['blog_title'] : null;
    $this->description = isset($data['blog_short_desc']) ? $data['blog_short_desc'] : null;
    $this->blog_date = isset($data['written_date']) ? $data['written_date'] : null;
    $this->last_update_date = isset($data['last_update_date']) ? ucfirst($data['last_update_date']) : null;
    $this->is_archive = isset($data['is_archive']) ? (int) $data['is_archive'] : (int) false;
    $this->is_draft = isset($data['is_draft']) ? (int) $data['is_draft'] : (int) false;
    $this->is_publish = isset($data['is_publish']) ? (int) $data['is_publish'] : (int) false;
    $this->total_comments = isset($data['total_comments']) ? (int) $data['total_comments'] : (int) false;
    $this->author = isset($data['username']) ? $data['username'] : null;
    $this->category = isset($data['category_title']) ? $data['category_title'] : null;
  }

}

?>
