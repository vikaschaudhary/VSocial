<?php
namespace VSocial\Google\Api\Youtube\Live;

use VSocial\Google\Service\Model;

class Broadcast
        extends Model {

    protected $__contentDetailsType = 'Google_LiveBroadcastContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__slateSettingsType = 'Google_LiveBroadcastSlateSettings';
    protected $__slateSettingsDataType = '';
    public $slateSettings;
    protected $__snippetType = 'Google_LiveBroadcastSnippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statusType = 'Google_LiveBroadcastStatus';
    protected $__statusDataType = '';
    public $status;

    public function setContentDetails (Google_LiveBroadcastContentDetails $contentDetails) {
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

    public function setSlateSettings (Google_LiveBroadcastSlateSettings $slateSettings) {
        $this->slateSettings = $slateSettings;
    }

    public function getSlateSettings () {
        return $this->slateSettings;
    }

    public function setSnippet (Google_LiveBroadcastSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatus (Google_LiveBroadcastStatus $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

}

?>
