<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;

class Cover
        extends Model {

    protected $__coverInfoType = '\\VSocial\\Google\\Api\\Plus\\Person\\Cover\\Info';
    protected $__coverInfoDataType = '';
    public $coverInfo;
    protected $__coverPhotoType = '\\VSocial\\Google\\Api\\Plus\\Person\\Cover\\Photo';
    protected $__coverPhotoDataType = '';
    public $coverPhoto;
    public $layout;

    public function setCoverInfo (Cover\Info $coverInfo) {
        $this->coverInfo = $coverInfo;
    }

    public function getCoverInfo () {
        return $this->coverInfo;
    }

    public function setCoverPhoto (Cover\Photo $coverPhoto) {
        $this->coverPhoto = $coverPhoto;
    }

    public function getCoverPhoto () {
        return $this->coverPhoto;
    }

    public function setLayout ($layout) {
        $this->layout = $layout;
    }

    public function getLayout () {
        return $this->layout;
    }

}

?>
