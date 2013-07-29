<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;

class Feed
        extends Model {

    public $etag;
    protected $__itemsType = '\\VSocial\\Google\\Api\\Plus\\Person';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;
    public $nextPageToken;
    public $selfLink;
    public $title;
    public $totalItems;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setItems (/* array(Google_Person) */ $items) {
        $this->assertIsArray($items, '\\VSocial\\Google\\Api\\Plus\\Person', __METHOD__);
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

    public function setTotalItems ($totalItems) {
        $this->totalItems = $totalItems;
    }

    public function getTotalItems () {
        return $this->totalItems;
    }

}

?>
