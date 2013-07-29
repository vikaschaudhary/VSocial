<?php

namespace Blog\Model;

class Blogs {

  public $blog_id;
  public $category_id;
  public $user_id;
  public $title;
  public $author;
  public $description;
  public $content;
  public $keywords;
  public $category;
  public $is_archive;
  public $is_draft;
  public $is_publish;
  public $images;
  public $comments_count;
  public $create_date;

  public function exchangeArray($data) {
    $this->blog_id = (!empty($data['blog_id'])) ? $data['blog_id'] : null;
    $this->category_id = (!empty($data['category_id'])) ? $data['category_id'] : null;
    $this->user_id = (!empty($data['author_id'])) ? $data['author_id'] : null;
    $this->title = (!empty($data['title'])) ? $data['title'] : null;
    $this->author = (!empty($data['author'])) ? $data['author'] : null;
    $this->description = (!empty($data['description'])) ? $data['description'] : null;
    $this->content = (!empty($data['content'])) ? $data['content'] : null;
    $this->keywords = (!empty($data['keywords'])) ? $data['keywords'] : null;
    $this->category = (!empty($data['category'])) ? $data['category'] : null;
    $this->is_archive = ($data['is_archive']) ? $data['is_archive'] : (int) false;
    $this->is_draft = ($data['is_draft']) ? $data['is_draft'] : (int) false;
    $this->is_publish = ($data['is_publish']) ? $data['is_publish'] : (int) false;
    $this->images = ($data['images']) ? $data['images'] : null;
    $this->comments_count = isset($data['comments_count']) ? $data['comments_count'] : 0;
    $this->create_date = isset($data['create_date']) ? $data['create_date'] : 0;
  }

}

?>
