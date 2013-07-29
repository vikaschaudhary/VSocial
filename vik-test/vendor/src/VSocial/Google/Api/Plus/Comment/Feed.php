<?php
namespace VSocial\Google\Api\Plus\Comment;

use VSocial\Google\Service\Model;

class Feed
        extends Model {

    public $etag;
    public $id;
    protected $__itemsType = 'Google_Comment';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;
    public $nextLink;
    public $nextPageToken;
    public $title;
    public $updated;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setItems (/* array(Google_Comment) */ $items) {
        $this->assertIsArray($items, 'Google_Comment', __METHOD__);
        $this->items = $items;
    }

    public function getItems () {
        return $this->items;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setNextLink ($nextLink) {
        $this->nextLink = $nextLink;
    }

    public function getNextLink () {
        return $this->nextLink;
    }

    public function setNextPageToken ($nextPageToken) {
        $this->nextPageToken = $nextPageToken;
    }

    public function getNextPageToken () {
        return $this->nextPageToken;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

    public function setUpdated ($updated) {
        $this->updated = $updated;
    }

    public function getUpdated () {
        return $this->updated;
    }

}

?>
