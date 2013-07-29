<?php
namespace VSocial\Google\Api\Plus\Moment;

use VSocial\Google\Service\Model;

class Feed
        extends Model {

    public $etag;
    protected $__itemsType = 'Google_Moment';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;
    public $nextLink;
    public $nextPageToken;
    public $selfLink;
    public $title;
    public $updated;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setItems (/* array(Google_Moment) */ $items) {
        $this->assertIsArray($items, 'Google_Moment', __METHOD__);
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

    public function setSelfLink ($selfLink) {
        $this->selfLink = $selfLink;
    }

    public function getSelfLink () {
        return $this->selfLink;
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
