<?php

namespace Admin\Model;

class Admin {

  public $user_id;
  public $username;
  public $first_name;
  public $last_name;
  public $gender;
  public $date_of_birth;
  public $email;
  public $password;
  public $name;
  public $image_url;
  public $image_controls;
  public $profile_image;
  public $isAdmin;

  public function exchangeArray($data) {
    $this->user_id = isset($data['user_id']) ? $data['user_id'] : null;
    $this->email = isset($data['user_email']) ? $data['user_email'] : null;
    $this->username = isset($data['username']) ? $data['username'] : null;
    $this->password = isset($data['password']) ? $data['password'] : null;
    $this->first_name = isset($data['first_name']) ? $data['first_name'] : null;
    $this->last_name = isset($data['last_name']) ? $data['last_name'] : null;
    $this->gender = isset($data['gender']) ? ucfirst($data['gender']) : null;
    $this->date_of_birth = isset($data['date_of_birth']) ? $data['date_of_birth'] : null;
    $this->name = trim("{$this->first_name} {$this->last_name}");
    $this->image_controls = isset($data['image_controls']) ? $data['image_controls'] : null;
    $this->image_url = isset($data['image_url']) ? $data['image_url'] : null;
    $this->profile_image = isset($data['profile_image']) ? $data['profile_image'] : null;

    $this->isAdmin = isset($data['isAdmin']) ? $data['isAdmin'] : (int) false;
  }

}

?>
