<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class RecordingDetails
        extends Model {

    protected $__locationType = 'Google_GeoPoint';
    protected $__locationDataType = '';
    public $location;
    public $locationDescription;
    public $recordingDate;

    public function setLocation (Google_GeoPoint $location) {
        $this->location = $location;
    }

    public function getLocation () {
        return $this->location;
    }

    public function setLocationDescription ($locationDescription) {
        $this->locationDescription = $locationDescription;
    }

    public function getLocationDescription () {
        return $this->locationDescription;
    }

    public function setRecordingDate ($recordingDate) {
        $this->recordingDate = $recordingDate;
    }

    public function getRecordingDate () {
        return $this->recordingDate;
    }

}

?>