<?php
namespace VSocial\Google\Api\Youtube\Playlist\Item;

use VSocial\Google\Service\Model;

class Snippet
        extends Model {

    public $channelId;
    public $description;
    public $playlistId;
    public $position;
    public $publishedAt;
    protected $__resourceIdType = 'Google_ResourceId';
    protected $__resourceIdDataType = '';
    public $resourceId;
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

    public function setPlaylistId ($playlistId) {
        $this->playlistId = $playlistId;
    }

    public function getPlaylistId () {
        return $this->playlistId;
    }

    public function setPosition ($position) {
        $this->position = $position;
    }

    public function getPosition () {
        return $this->position;
    }

    public function setPublishedAt ($publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    public function getPublishedAt () {
        return $this->publishedAt;
    }

    public function setResourceId (Google_ResourceId $resourceId) {
        $this->resourceId = $resourceId;
    }

    public function getResourceId () {
        return $this->resourceId;
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
