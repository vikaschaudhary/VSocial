<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class GeoPoint
        extends Model {

    public $elevation;
    public $latitude;
    public $longitude;

    public function setElevation ($elevation) {
        $this->elevation = $elevation;
    }

    public function getElevation () {
        return $this->elevation;
    }

    public function setLatitude ($latitude) {
        $this->latitude = $latitude;
    }

    public function getLatitude () {
        return $this->latitude;
    }

    public function setLongitude ($longitude) {
        $this->longitude = $longitude;
    }

    public function getLongitude () {
        return $this->longitude;
    }

}

?>
