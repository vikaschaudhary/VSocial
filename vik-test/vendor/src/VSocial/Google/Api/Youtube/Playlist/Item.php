<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\Model;

class Item
        extends Model {

    protected $__contentDetailsType = 'Google_PlaylistItemContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = 'Google_PlaylistItemSnippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statusType = 'Google_PlaylistItemStatus';
    protected $__statusDataType = '';
    public $status;

    public function setContentDetails (Google_PlaylistItemContentDetails $contentDetails) {
        $this->contentDetails = $contentDetails;
    }

    public function getContentDetails () {
        return $this->contentDetails;
    }

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

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setSnippet (Google_PlaylistItemSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatus (Google_PlaylistItemStatus $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

}

?>
