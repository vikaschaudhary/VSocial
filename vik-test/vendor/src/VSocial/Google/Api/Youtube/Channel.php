<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Channel
        extends Model {

    protected $__brandingSettingsType = '\\VSocial\Google\\Api\\Youtube\\Channels\\BrandingSettings';
    protected $__brandingSettingsDataType = '';
    public $brandingSettings;
    protected $__contentDetailsType = '\\VSocial\Google\\Api\\Youtube\\Channels\\ContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = '\\VSocial\Google\\Api\\Youtube\\Channels\\Snippet';
    protected $__snippetDataType = '';
    public $snippet;
    protected $__statisticsType = '\\VSocial\Google\\Api\\Youtube\\Channels\\Statistics';
    protected $__statisticsDataType = '';
    public $statistics;
    protected $__statusType = '\\VSocial\Google\\Api\\Youtube\\Channels\\Status';
    protected $__statusDataType = '';
    public $status;
    protected $__topicDetailsType = '\\VSocial\Google\\Api\\Youtube\\Channels\\TopicDetails';
    protected $__topicDetailsDataType = '';
    public $topicDetails;

    public function setBrandingSettings (Channels\BrandingSettings $brandingSettings) {
        $this->brandingSettings = $brandingSettings;
    }

    public function getBrandingSettings () {
        return $this->brandingSettings;
    }

    public function setContentDetails (Channels\ContentDetails $contentDetails) {
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

    public function setSnippet (Channels\Snippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

    public function setStatistics (Channels\Statistics $statistics) {
        $this->statistics = $statistics;
    }

    public function getStatistics () {
        return $this->statistics;
    }

    public function setStatus (Channels\Status $status) {
        $this->status = $status;
    }

    public function getStatus () {
        return $this->status;
    }

    public function setTopicDetails (Channels\TopicDetails $topicDetails) {
        $this->topicDetails = $topicDetails;
    }

    public function getTopicDetails () {
        return $this->topicDetails;
    }

}

?>
