<?php
namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;

class Replies
        extends Model {

    public $selfLink;
    public $totalItems;

    public function setSelfLink ($selfLink) {
        $this->selfLink = $selfLink;
    }

    public function getSelfLink () {
        return $this->selfLink;
    }

    public function setTotalItems ($totalItems) {
        $this->totalItems = $totalItems;
    }

    public function getTotalItems () {
        return $this->totalItems;
    }

}

?>
