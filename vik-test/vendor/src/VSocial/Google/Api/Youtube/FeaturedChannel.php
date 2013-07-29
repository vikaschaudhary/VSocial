<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class FeaturedChannel
        extends Model {

    public $channelId;
    protected $__channelSnippetType = '\\VSocial\\Google\\Api\Youtube\\Channels\\Snippet';
    protected $__channelSnippetDataType = '';
    public $channelSnippet;
    public $endTimeMs;
    public $featureId;
    public $startTimeMs;
    public $watermarkUrl;

    public function setChannelId ($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId () {
        return $this->channelId;
    }

    public function setChannelSnippet (Channels\Snippet $channelSnippet) {
        $this->channelSnippet = $channelSnippet;
    }

    public function getChannelSnippet () {
        return $this->channelSnippet;
    }

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

    public function setWatermarkUrl ($watermarkUrl) {
        $this->watermarkUrl = $watermarkUrl;
    }

    public function getWatermarkUrl () {
        return $this->watermarkUrl;
    }

}

?>
