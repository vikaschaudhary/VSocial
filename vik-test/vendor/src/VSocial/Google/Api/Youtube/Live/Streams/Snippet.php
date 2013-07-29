<?php
namespace VSocial\Google\Api\Youtube\Live\Streams;

use VSocial\Google\Service\Model;

class Snippet
        extends Model {

    public $channelId;
    public $description;
    public $publishedAt;
    public $title;

    public function setChannelId ($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId () {
        return $this->channelId;
    }

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setPublishedAt ($publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    public function getPublishedAt () {
        return $this->publishedAt;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

}

?>
