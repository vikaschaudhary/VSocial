<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\Model;

class Snippet
        extends Model {

    public $channelId;
    public $description;
    public $publishedAt;
    protected $__thumbnailsType = 'Google_ThumbnailDetails';
    protected $__thumbnailsDataType = '';
    public $thumbnails;
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

    public function setThumbnails (Google_ThumbnailDetails $thumbnails) {
        $this->thumbnails = $thumbnails;
    }

    public function getThumbnails () {
        return $this->thumbnails;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

}

?>
