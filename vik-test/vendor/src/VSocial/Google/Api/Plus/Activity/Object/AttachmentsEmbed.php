<?php
namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;


class AttachmentsEmbed
        extends Model {

    public $type;
    public $url;

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
