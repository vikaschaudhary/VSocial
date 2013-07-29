<?php
namespace VSocial\Google\Api\Youtube\Subscriptions;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $newItemCount;
    public $totalItemCount;

    public function setNewItemCount ($newItemCount) {
        $this->newItemCount = $newItemCount;
    }

    public function getNewItemCount () {
        return $this->newItemCount;
    }

    public function setTotalItemCount ($totalItemCount) {
        $this->totalItemCount = $totalItemCount;
    }

    public function getTotalItemCount () {
        return $this->totalItemCount;
    }

}

?>
