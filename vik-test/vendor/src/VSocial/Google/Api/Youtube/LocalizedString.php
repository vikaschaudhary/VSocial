<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class LocalizedString
        extends Model {

    public $language;
    public $value;

    public function setLanguage ($language) {
        $this->language = $language;
    }

    public function getLanguage () {
        return $this->language;
    }

    public function setValue ($value) {
        $this->value = $value;
    }

    public function getValue () {
        return $this->value;
    }

}

?>
