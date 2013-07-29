<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $itemCount;

    public function setItemCount ($itemCount) {
        $this->itemCount = $itemCount;
    }

    public function getItemCount () {
        return $this->itemCount;
    }

}

?>
