<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class PropertyValue
        extends Model {

    public $property;
    public $value;

    public function setProperty ($property) {
        $this->property = $property;
    }

    public function getProperty () {
        return $this->property;
    }

    public function setValue ($value) {
        $this->value = $value;
    }

    public function getValue () {
        return $this->value;
    }

}

?>
