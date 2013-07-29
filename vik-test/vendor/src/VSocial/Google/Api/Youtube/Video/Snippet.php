<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class Snippet
        extends Model {

    public $categoryId;
    public $channelId;
    public $channelTitle;
    public $description;
    public $publishedAt;
    public $tags;
    protected $__thumbnailsType = 'Google_ThumbnailDetails';
    protected $__thumbnailsDataType = '';
    public $thumbnails;
    public $title;

    public function setCategoryId ($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId () {
        return $this->categoryId;
    }

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

    public function setPublishedAt ($publishedAt) {
        $this->publishedAt = $publishedAt;
    }

    public function getPublishedAt () {
        return $this->publishedAt;
    }

    public function setTags (/* array(Google_string) */ $tags) {
        $this->assertIsArray($tags, 'Google_string', __METHOD__);
        $this->tags = $tags;
    }

    public function getTags () {
        return $this->tags;
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