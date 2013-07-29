<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class ThumbnailDetails
        extends Model {

    protected $__defaultType = 'Google_Thumbnail';
    protected $__defaultDataType = '';
    public $default;
    protected $__highType = 'Google_Thumbnail';
    protected $__highDataType = '';
    public $high;
    protected $__maxresType = 'Google_Thumbnail';
    protected $__maxresDataType = '';
    public $maxres;
    protected $__mediumType = 'Google_Thumbnail';
    protected $__mediumDataType = '';
    public $medium;
    protected $__standardType = 'Google_Thumbnail';
    protected $__standardDataType = '';
    public $standard;

    public function setDefault (Google_Thumbnail $default) {
        $this->default = $default;
    }

    public function getDefault () {
        return $this->default;
    }

    public function setHigh (Google_Thumbnail $high) {
        $this->high = $high;
    }

    public function getHigh () {
        return $this->high;
    }

    public function setMaxres (Google_Thumbnail $maxres) {
        $this->maxres = $maxres;
    }

    public function getMaxres () {
        return $this->maxres;
    }

    public function setMedium (Google_Thumbnail $medium) {
        $this->medium = $medium;
    }

    public function getMedium () {
        return $this->medium;
    }

    public function setStandard (Google_Thumbnail $standard) {
        $this->standard = $standard;
    }

    public function getStandard () {
        return $this->standard;
    }

}

?>
