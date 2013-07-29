<?php
namespace VSocial\Google\Api\Youtube\Live;

use VSocial\Google\Service\Model;

class Stream
        extends Model {

    protected $__cdnType = 'Google_LiveStreamCdn';
    protected $__cdnDataType = '';
    public $cdn;
    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = 'Google_LiveStreamSnippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statusType = 'Google_LiveStreamStatus';
    protected $__statusDataType = '';
    public $status;

    public function setCdn (Google_LiveStreamCdn $cdn) {
        $this->cdn = $cdn;
    }

    public function getCdn () {
        return $this->cdn;
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

    public function setSnippet (Google_LiveStreamSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatus (Google_LiveStreamStatus $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

}

?>
