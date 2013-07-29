<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class FileDetails
        extends Model {

    protected $__audioStreamsType = 'Google_VideoFileDetailsAudioStream';
    protected $__audioStreamsDataType = 'array';
    public $audioStreams;
    public $bitrateBps;
    public $container;
    public $creationTime;
    public $durationMs;
    public $fileName;
    public $fileSize;
    public $fileType;
    protected $__recordingLocationType = 'Google_GeoPoint';
    protected $__recordingLocationDataType = '';
    public $recordingLocation;
    protected $__videoStreamsType = 'Google_VideoFileDetailsVideoStream';
    protected $__videoStreamsDataType = 'array';
    public $videoStreams;

    public function setAudioStreams (/* array(Google_VideoFileDetailsAudioStream) */ $audioStreams) {
        $this->assertIsArray($audioStreams, 'Google_VideoFileDetailsAudioStream', __METHOD__);
        $this->audioStreams = $audioStreams;
    }

    public function getAudioStreams () {
        return $this->audioStreams;
    }

    public function setBitrateBps ($bitrateBps) {
        $this->bitrateBps = $bitrateBps;
    }

    public function getBitrateBps () {
        return $this->bitrateBps;
    }

    public function setContainer ($container) {
        $this->container = $container;
    }

    public function getContainer () {
        return $this->container;
    }

    public function setCreationTime ($creationTime) {
        $this->creationTime = $creationTime;
    }

    public function getCreationTime () {
        return $this->creationTime;
    }

    public function setDurationMs ($durationMs) {
        $this->durationMs = $durationMs;
    }

    public function getDurationMs () {
        return $this->durationMs;
    }

    public function setFileName ($fileName) {
        $this->fileName = $fileName;
    }

    public function getFileName () {
        return $this->fileName;
    }

    public function setFileSize ($fileSize) {
        $this->fileSize = $fileSize;
    }

    public function getFileSize () {
        return $this->fileSize;
    }

    public function setFileType ($fileType) {
        $this->fileType = $fileType;
    }

    public function getFileType () {
        return $this->fileType;
    }

    public function setRecordingLocation (Google_GeoPoint $recordingLocation) {
        $this->recordingLocation = $recordingLocation;
    }

    public function getRecordingLocation () {
        return $this->recordingLocation;
    }

    public function setVideoStreams (/* array(Google_VideoFileDetailsVideoStream) */ $videoStreams) {
        $this->assertIsArray($videoStreams, 'Google_VideoFileDetailsVideoStream', __METHOD__);
        $this->videoStreams = $videoStreams;
    }

    public function getVideoStreams () {
        return $this->videoStreams;
    }

}

?>