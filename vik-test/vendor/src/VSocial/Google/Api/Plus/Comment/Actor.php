<?php
namespace VSocial\Google\Api\Plus\Comment;

use VSocial\Google\Service\Model;

class Actor
        extends Model {

    public $displayName;
    public $id;
    protected $__imageType = 'Google_CommentActorImage';
    protected $__imageDataType = '';
    public $image;
    public $url;

    public function setDisplayName ($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName () {
        return $this->displayName;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setImage (Google_CommentActorImage $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
