<?php
namespace VSocial\Google\Api\Plus\Comment;

use VSocial\Google\Service\Model;

class ActorImage
        extends Model {

    public $url;

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
