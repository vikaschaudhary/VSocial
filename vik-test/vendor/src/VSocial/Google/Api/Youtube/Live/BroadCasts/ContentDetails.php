<?php
namespace VSocial\Google\Api\Youtube\Live\BroadCasts;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $boundStreamId;
    protected $__enableArchiveType = 'Google_LiveBroadcastContentDetailsEnableArchive';
    protected $__enableArchiveDataType = '';
    public $enableArchive;
    public $enableContentEncryption;
    public $enableDvr;
    public $enableEmbed;
    protected $__monitorStreamType = 'Google_LiveBroadcastContentDetailsMonitorStream';
    protected $__monitorStreamDataType = '';
    public $monitorStream;
    public $recordFromStart;
    public $startWithSlate;
    protected $__startWithSlateCuepointType = 'Google_LiveBroadcastContentDetailsStartWithSlateCuepoint';
    protected $__startWithSlateCuepointDataType = '';
    public $startWithSlateCuepoint;

    public function setBoundStreamId ($boundStreamId) {
        $this->boundStreamId = $boundStreamId;
    }

    public function getBoundStreamId () {
        return $this->boundStreamId;
    }

    public function setEnableArchive (Google_LiveBroadcastContentDetailsEnableArchive $enableArchive) {
        $this->enableArchive = $enableArchive;
    }

    public function getEnableArchive () {
        return $this->enableArchive;
    }

    public function setEnableContentEncryption ($enableContentEncryption) {
        $this->enableContentEncryption = $enableContentEncryption;
    }

    public function getEnableContentEncryption () {
        return $this->enableContentEncryption;
    }

    public function setEnableDvr ($enableDvr) {
        $this->enableDvr = $enableDvr;
    }

    public function getEnableDvr () {
        return $this->enableDvr;
    }

    public function setEnableEmbed ($enableEmbed) {
        $this->enableEmbed = $enableEmbed;
    }

    public function getEnableEmbed () {
        return $this->enableEmbed;
    }

    public function setMonitorStream (Google_LiveBroadcastContentDetailsMonitorStream $monitorStream) {
        $this->monitorStream = $monitorStream;
    }

    public function getMonitorStream () {
        return $this->monitorStream;
    }

    public function setRecordFromStart ($recordFromStart) {
        $this->recordFromStart = $recordFromStart;
    }

    public function getRecordFromStart () {
        return $this->recordFromStart;
    }

    public function setStartWithSlate ($startWithSlate) {
        $this->startWithSlate = $startWithSlate;
    }

    public function getStartWithSlate () {
        return $this->startWithSlate;
    }

    public function setStartWithSlateCuepoint (Google_LiveBroadcastContentDetailsStartWithSlateCuepoint $startWithSlateCuepoint) {
        $this->startWithSlateCuepoint = $startWithSlateCuepoint;
    }

    public function getStartWithSlateCuepoint () {
        return $this->startWithSlateCuepoint;
    }

}

?>
