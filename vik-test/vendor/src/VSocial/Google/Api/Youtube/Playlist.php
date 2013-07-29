<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Playlist
        extends Model {

    protected $__contentDetailsType = 'Google_PlaylistContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__playerType = 'Google_PlaylistPlayer';
    protected $__playerDataType = '';
    public $player;
    protected $__snippetType = 'Google_PlaylistSnippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statusType = 'Google_PlaylistStatus';
    protected $__statusDataType = '';
    public $status;

    public function setContentDetails (Google_PlaylistContentDetails $contentDetails) {
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

    public function setPlayer (Google_PlaylistPlayer $player) {
        $this->player = $player;
    }

    public function getPlayer () {
        return $this->player;
    }

    public function setSnippet (Google_PlaylistSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatus (Google_PlaylistStatus $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

}

?>
