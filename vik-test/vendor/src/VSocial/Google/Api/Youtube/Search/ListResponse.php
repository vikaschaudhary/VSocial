<?php
namespace VSocial\Google\Api\Youtube\Search;

use VSocial\Google\Service\Model;

class ListResponse
        extends Model {

    public $etag;
    protected $__itemsType = 'Google_SearchResult';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;
    public $nextPageToken;
    protected $__pageInfoType = 'Google_PageInfo';
    protected $__pageInfoDataType = '';
    public $pageInfo;
    public $prevPageToken;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setItems (/* array(Google_SearchResult) */ $items) {
        $this->assertIsArray($items, 'Google_SearchResult', __METHOD__);
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

    public function setPageInfo (Google_PageInfo $pageInfo) {
        $this->pageInfo = $pageInfo;
    }

    public function getPageInfo () {
        return $this->pageInfo;
    }

    public function setPrevPageToken ($prevPageToken) {
        $this->prevPageToken = $prevPageToken;
    }

    public function getPrevPageToken () {
        return $this->prevPageToken;
    }

}

?>