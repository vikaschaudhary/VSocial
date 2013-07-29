<?php
namespace VSocial\Google\Api\Youtube\Video\ContentDetails;

use VSocial\Google\Service\Model;

class RegionRestriction
        extends Model {

    public $allowed;
    public $blocked;

    public function setAllowed (/* array(Google_string) */ $allowed) {
        $this->assertIsArray($allowed, 'Google_string', __METHOD__);
        $this->allowed = $allowed;
    }

    public function getAllowed () {
        return $this->allowed;
    }

    public function setBlocked (/* array(Google_string) */ $blocked) {
        $this->assertIsArray($blocked, 'Google_string', __METHOD__);
        $this->blocked = $blocked;
    }

    public function getBlocked () {
        return $this->blocked;
    }

}

?>
