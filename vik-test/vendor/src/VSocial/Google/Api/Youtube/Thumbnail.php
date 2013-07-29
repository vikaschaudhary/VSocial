<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Thumbnail
        extends Model {

    public $height;
    public $url;
    public $width;

    public function setHeight ($height) {
        $this->height = $height;
    }

    public function getHeight () {
        return $this->height;
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
