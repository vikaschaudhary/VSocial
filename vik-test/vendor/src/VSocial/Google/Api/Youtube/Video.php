<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Video
        extends Model {

    protected $__ageGatingDetailsType = 'Google_VideoAgeGating';
    protected $__ageGatingDetailsDataType = '';
    public $ageGatingDetails;
    protected $__contentDetailsType = 'Google_VideoContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    protected $__fileDetailsType = 'Google_VideoFileDetails';
    protected $__fileDetailsDataType = '';
    public $fileDetails;
    public $id;
    public $kind;
    protected $__monetizationDetailsType = 'Google_VideoMonetizationDetails';
    protected $__monetizationDetailsDataType = '';
    public $monetizationDetails;
    protected $__playerType = 'Google_VideoPlayer';
    protected $__playerDataType = '';
    public $player;
    protected $__processingDetailsType = 'Google_VideoProcessingDetails';
    protected $__processingDetailsDataType = '';
    public $processingDetails;
    protected $__projectDetailsType = 'Google_VideoProjectDetails';
    protected $__projectDetailsDataType = '';
    public $projectDetails;
    protected $__recordingDetailsType = 'Google_VideoRecordingDetails';
    protected $__recordingDetailsDataType = '';
    public $recordingDetails;
    protected $__snippetType = 'Google_VideoSnippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statisticsType = 'Google_VideoStatistics';
    protected $__statisticsDataType = '';
    public $statistics;
    protected $__statusType = 'Google_VideoStatus';
    protected $__statusDataType = '';
    public $status;
    protected $__suggestionsType = 'Google_VideoSuggestions';
    protected $__suggestionsDataType = '';
    public $suggestions;
    protected $__topicDetailsType = 'Google_VideoTopicDetails';
    protected $__topicDetailsDataType = '';
    public $topicDetails;

    public function setAgeGatingDetails (Google_VideoAgeGating $ageGatingDetails) {
        $this->ageGatingDetails = $ageGatingDetails;
    }

    public function getAgeGatingDetails () {
        return $this->ageGatingDetails;
    }

    public function setContentDetails (Google_VideoContentDetails $contentDetails) {
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

    public function setFileDetails (Google_VideoFileDetails $fileDetails) {
        $this->fileDetails = $fileDetails;
    }

    public function getFileDetails () {
        return $this->fileDetails;
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

    public function setMonetizationDetails (Google_VideoMonetizationDetails $monetizationDetails) {
        $this->monetizationDetails = $monetizationDetails;
    }

    public function getMonetizationDetails () {
        return $this->monetizationDetails;
    }

    public function setPlayer (Google_VideoPlayer $player) {
        $this->player = $player;
    }

    public function getPlayer () {
        return $this->player;
    }

    public function setProcessingDetails (Google_VideoProcessingDetails $processingDetails) {
        $this->processingDetails = $processingDetails;
    }

    public function getProcessingDetails () {
        return $this->processingDetails;
    }

    public function setProjectDetails (Google_VideoProjectDetails $projectDetails) {
        $this->projectDetails = $projectDetails;
    }

    public function getProjectDetails () {
        return $this->projectDetails;
    }

    public function setRecordingDetails (Google_VideoRecordingDetails $recordingDetails) {
        $this->recordingDetails = $recordingDetails;
    }

    public function getRecordingDetails () {
        return $this->recordingDetails;
    }

    public function setSnippet (Google_VideoSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatistics (Google_VideoStatistics $statistics) {
        $this->statistics = $statistics;
    }

    public function getStatistics () {
        return $this->statistics;
    }

    public function setStatus (Google_VideoStatus $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

    public function setSuggestions (Google_VideoSuggestions $suggestions) {
        $this->suggestions = $suggestions;
    }

    public function getSuggestions () {
        return $this->suggestions;
    }

    public function setTopicDetails (Google_VideoTopicDetails $topicDetails) {
        $this->topicDetails = $topicDetails;
    }

    public function getTopicDetails () {
        return $this->topicDetails;
    }

}

?>
