<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class FeaturedVideo
        extends Model {

    public $endTimeMs;
    public $featureId;
    public $startTimeMs;
    public $videoId;
    protected $__videoSnippetType = '\\VSocial\\Google\\Api\Youtube\\Video\\Snippet';
    protected $__videoSnippetDataType = '';
    public $videoSnippet;

    public function setEndTimeMs ($endTimeMs) {
        $this->endTimeMs = $endTimeMs;
    }

    public function getEndTimeMs () {
        return $this->endTimeMs;
    }

    public function setFeatureId ($featureId) {
        $this->featureId = $featureId;
    }

    public function getFeatureId () {
        return $this->featureId;
    }

    public function setStartTimeMs ($startTimeMs) {
        $this->startTimeMs = $startTimeMs;
    }

    public function getStartTimeMs () {
        return $this->startTimeMs;
    }

    public function setVideoId ($videoId) {
        $this->videoId = $videoId;
    }

    public function getVideoId () {
        return $this->videoId;
    }

    public function setVideoSnippet (Video\Snippet $videoSnippet) {
        $this->videoSnippet = $videoSnippet;
    }

    public function getVideoSnippet () {
        return $this->videoSnippet;
    }

}

?>
