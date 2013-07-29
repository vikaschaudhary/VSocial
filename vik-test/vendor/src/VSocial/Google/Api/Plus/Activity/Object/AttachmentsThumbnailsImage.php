<?php
namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;

class AttachmentsThumbnailsImage
        extends Model {

    public $height;
    public $type;
    public $url;
    public $width;

    public function setHeight ($height) {
        $this->height = $height;
    }

    public function getHeight () {
        return $this->height;
    }

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

    public function setWidth ($width) {
        $this->width = $width;
    }

    public function getWidth () {
        return $this->width;
    }

}


?>
