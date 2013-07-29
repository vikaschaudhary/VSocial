<?php
namespace VSocial\Google\Api\Plus\Activity;

use VSocial\Google\Service\Model;

class ActorName
        extends Model {

    public $familyName;
    public $givenName;

    public function setFamilyName ($familyName) {
        $this->familyName = $familyName;
    }

    public function getFamilyName () {
        return $this->familyName;
    }

    public function setGivenName ($givenName) {
        $this->givenName = $givenName;
    }

    public function getGivenName () {
        return $this->givenName;
    }

}

?>
