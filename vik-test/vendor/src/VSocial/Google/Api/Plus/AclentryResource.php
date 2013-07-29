<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class AclentryResource
        extends Model {

    public $displayName;
    public $id;
    public $type;

    public function setDisplayName ($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName () {
        return $this->displayName;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

}

?>
