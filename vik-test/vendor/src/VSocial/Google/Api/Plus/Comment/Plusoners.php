<?php
namespace VSocial\Google\Api\Plus\Comment;

use VSocial\Google\Service\Model;
class Plusoners
        extends Model {

    public $totalItems;

    public function setTotalItems ($totalItems) {
        $this->totalItems = $totalItems;
    }

    public function getTotalItems () {
        return $this->totalItems;
    }

}

?>
