<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class ListResponse
        extends Model {

    public $etag;
    protected $__itemsType = 'Google_Video';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setItems (/* array(Google_Video) */ $items) {
        $this->assertIsArray($items, 'Google_Video', __METHOD__);
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

}

?>
