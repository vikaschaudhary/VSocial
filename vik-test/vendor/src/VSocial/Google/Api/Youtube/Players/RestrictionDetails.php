<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\Model;

class RestrictionDetails
        extends Model {

    public $reason;
    public $restricted;
    public $restriction;

    public function setReason ($reason) {
        $this->reason = $reason;
    }

    public function getReason () {
        return $this->reason;
    }

    public function setRestricted ($restricted) {
        $this->restricted = $restricted;
    }

    public function getRestricted () {
        return $this->restricted;
    }

    public function setRestriction ($restriction) {
        $this->restriction = $restriction;
    }

    public function getRestriction () {
        return $this->restriction;
    }

}

?>
