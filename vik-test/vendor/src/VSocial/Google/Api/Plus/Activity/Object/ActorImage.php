<?php
namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;

class ActorImage
        extends Model {

    public $url;

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
