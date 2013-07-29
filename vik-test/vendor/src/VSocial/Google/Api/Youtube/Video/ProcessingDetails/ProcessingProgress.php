<?php
namespace VSocial\Google\Api\Youtube\Video\ProcessingDetails;

use VSocial\Google\Service\Model;
class ProcessingProgress
        extends Model {

    public $partsProcessed;
    public $partsTotal;
    public $timeLeftMs;

    public function setPartsProcessed ($partsProcessed) {
        $this->partsProcessed = $partsProcessed;
    }

    public function getPartsProcessed () {
        return $this->partsProcessed;
    }

    public function setPartsTotal ($partsTotal) {
        $this->partsTotal = $partsTotal;
    }

    public function getPartsTotal () {
        return $this->partsTotal;
    }

    public function setTimeLeftMs ($timeLeftMs) {
        $this->timeLeftMs = $timeLeftMs;
    }

    public function getTimeLeftMs () {
        return $this->timeLeftMs;
    }

}

?>