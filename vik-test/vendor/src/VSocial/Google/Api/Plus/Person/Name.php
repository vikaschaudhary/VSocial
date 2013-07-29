<?php

namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;

class Name
        extends Model {

    public $familyName;
    public $formatted;
    public $givenName;
    public $honorificPrefix;
    public $honorificSuffix;
    public $middleName;

    public function setFamilyName ($familyName) {
        $this->familyName = $familyName;
    }

    public function getFamilyName () {
        return $this->familyName;
    }

    public function setFormatted ($formatted) {
        $this->formatted = $formatted;
    }

    public function getFormatted () {
        return $this->formatted;
    }

    public function setGivenName ($givenName) {
        $this->givenName = $givenName;
    }

    public function getGivenName () {
        return $this->givenName;
    }

    public function setHonorificPrefix ($honorificPrefix) {
        $this->honorificPrefix = $honorificPrefix;
    }

    public function getHonorificPrefix () {
        return $this->honorificPrefix;
    }

    public function setHonorificSuffix ($honorificSuffix) {
        $this->honorificSuffix = $honorificSuffix;
    }

    public function getHonorificSuffix () {
        return $this->honorificSuffix;
    }

    public function setMiddleName ($middleName) {
        $this->middleName = $middleName;
    }

    public function getMiddleName () {
        return $this->middleName;
    }

}

?>
