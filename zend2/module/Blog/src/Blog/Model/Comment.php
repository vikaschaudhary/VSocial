<?php

namespace Blog\Model;

class Comment {

  public $blog_id;
  public $comment_id;
  public $user_id;
  public $username;
  public $content;
  public $comment_date;
  public $status;

  public function exchangeArray($data) {
    $this->blog_id = (!empty($data['blog_id'])) ? $data['blog_id'] : null;
    $this->comment_id = (!empty($data['comment_id'])) ? $data['comment_id'] : null;
    $this->user_id = ($data['user_id']) ? $data['user_id'] : null;
    $this->content = ($data['comment_text']) ? $data['comment_text'] : null;
    $this->comment_date = ($data['comment_date']) ? $data['comment_date'] : null;
    $this->username = ($data['username']) ? $data['username'] : null;
    $this->status = ($data['status']) ? $data['status'] : 0;
  }

}

?>
