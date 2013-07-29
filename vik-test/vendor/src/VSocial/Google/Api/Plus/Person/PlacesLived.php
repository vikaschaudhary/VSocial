<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;
class PlacesLived
        extends Model {

    public $primary;
    public $value;

    public function setPrimary ($primary) {
        $this->primary = $primary;
    }

    public function getPrimary () {
        return $this->primary;
    }

    public function setValue ($value) {
        $this->value = $value;
    }

    public function getValue () {
        return $this->value;
    }

}

?>
