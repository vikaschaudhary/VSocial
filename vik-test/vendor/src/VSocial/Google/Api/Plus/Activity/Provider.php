<?php
namespace VSocial\Google\Api\Plus\Activity;

use VSocial\Google\Service\Model;

class Provider
        extends Model {

    public $title;

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

}

?>
