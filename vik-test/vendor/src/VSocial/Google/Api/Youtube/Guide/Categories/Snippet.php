<?php
namespace VSocial\Google\Api\Youtube\Guide\Categories;

use VSocial\Google\Service\Model;

class Snippet
        extends Model {

    public $channelId;
    public $title;

    public function setChannelId ($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId () {
        return $this->channelId;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

}

?>
