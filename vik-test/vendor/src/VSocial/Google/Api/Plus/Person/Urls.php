<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;

class Urls
        extends Model {

    public $primary;
    public $type;
    public $value;

    public function setPrimary ($primary) {
        $this->primary = $primary;
    }

    public function getPrimary () {
        return $this->primary;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

    public function setValue ($value) {
        $this->value = $value;
    }

    public function getValue () {
        return $this->value;
    }

}

?>
