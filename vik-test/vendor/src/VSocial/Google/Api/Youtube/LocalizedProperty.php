<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class LocalizedProperty
        extends Model {

    public $default;
    protected $__localizedType = '\\VSocial\\Google\\Api\Youtube\\LocalizedString';
    protected $__localizedDataType = 'array';
    public $localized;

    public function setDefault ($default) {
        $this->default = $default;
    }

    public function getDefault () {
        return $this->default;
    }

    public function setLocalized (/* array(Google_LocalizedString) */ $localized) {
        $this->assertIsArray($localized, '\\VSocial\\Google\\Api\Youtube\\LocalizedString', __METHOD__);
        $this->localized = $localized;
    }

    public function getLocalized () {
        return $this->localized;
    }

}

?>
