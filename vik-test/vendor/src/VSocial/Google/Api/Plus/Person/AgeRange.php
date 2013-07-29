<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;

class AgeRange
        extends Model {

    public $max;
    public $min;

    public function setMax ($max) {
        $this->max = $max;
    }

    public function getMax () {
        return $this->max;
    }

    public function setMin ($min) {
        $this->min = $min;
    }

    public function getMin () {
        return $this->min;
    }

}

?>
