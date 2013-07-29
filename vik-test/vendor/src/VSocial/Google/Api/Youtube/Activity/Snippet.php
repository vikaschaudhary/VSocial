<?php
namespace VSocial\Google\Api\Youtube\Activity;

use VSocial\Google\Service\Model;
use VSocial\Google\Api\Youtube\ThumbnailDetails;

class Snippet
        extends Model {

    public $channelId;
    public $channelTitle;
    public $description;
    public $groupId;
    public $publishedAt;
    protected $__thumbnailsType = '\\VSocial\Google\\Api\\Youtube\\ThumbnailDetails';
    protected $__thumbnailsDataType = '';
    public $thumbnails;
    public $title;
    public $type;

    public function setChannelId ($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId () {
        return $this->channelId;
    }

    public function setChannelTitle ($channelTitle) {
        $this->channelTitle = $channelTitle;
    }

    public function getChannelTitle () {
        return $this->channelTitle;
    }

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setGroupId ($groupId) {
        $this->groupId = $groupId;
    }

    public function getGroupId () {
        return $this->groupId;
    }

    public function setPublishedAt ($publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    public function getPublishedAt () {
        return $this->publishedAt;
    }

    public function setThumbnails (ThumbnailDetails $thumbnails) {
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

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

}

?>
