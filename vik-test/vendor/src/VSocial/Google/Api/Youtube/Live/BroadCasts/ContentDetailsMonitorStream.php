<?php
namespace VSocial\Google\Api\Youtube\Live\BroadCasts;

use VSocial\Google\Service\Model;

class ContentDetailsMonitorStream
        extends Model {

    public $broadcastStreamDelayMs;
    public $embedHtml;
    public $enableMonitorStream;

    public function setBroadcastStreamDelayMs ($broadcastStreamDelayMs) {
        $this->broadcastStreamDelayMs = $broadcastStreamDelayMs;
    }

    public function getBroadcastStreamDelayMs () {
        return $this->broadcastStreamDelayMs;
    }

    public function setEmbedHtml ($embedHtml) {
        $this->embedHtml = $embedHtml;
    }

    public function getEmbedHtml () {
        return $this->embedHtml;
    }

    public function setEnableMonitorStream ($enableMonitorStream) {
        $this->enableMonitorStream = $enableMonitorStream;
    }

    public function getEnableMonitorStream () {
        return $this->enableMonitorStream;
    }

}

?>
