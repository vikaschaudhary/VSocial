<?php
namespace VSocial\Google\Api\Youtube\Live\BroadCasts;

use VSocial\Google\Service\Model;

class Status
        extends Model {

    public $lifeCycleStatus;
    public $privacyStatus;

    public function setLifeCycleStatus ($lifeCycleStatus) {
        $this->lifeCycleStatus = $lifeCycleStatus;
    }

    public function getLifeCycleStatus () {
        return $this->lifeCycleStatus;
    }

    public function setPrivacyStatus ($privacyStatus) {
        $this->privacyStatus = $privacyStatus;
    }

    public function getPrivacyStatus () {
        return $this->privacyStatus;
    }

}

?>
