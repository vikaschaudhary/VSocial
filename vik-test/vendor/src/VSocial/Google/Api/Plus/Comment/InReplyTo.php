<?php
namespace VSocial\Google\Api\Plus\Comment;

use VSocial\Google\Service\Model;
class InReplyTo
        extends Model {

    public $id;
    public $url;

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
