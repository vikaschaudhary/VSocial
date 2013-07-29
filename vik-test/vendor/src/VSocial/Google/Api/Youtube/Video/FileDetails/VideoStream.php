<?php
namespace VSocial\Google\Api\Youtube\Video\FileDetails;

use VSocial\Google\Service\Model;

class VideoStream
        extends Model {

    public $aspectRatio;
    public $bitrateBps;
    public $codec;
    public $frameRateFps;
    public $heightPixels;
    public $rotation;
    public $vendor;
    public $widthPixels;

    public function setAspectRatio ($aspectRatio) {
        $this->aspectRatio = $aspectRatio;
    }

    public function getAspectRatio () {
        return $this->aspectRatio;
    }

    public function setBitrateBps ($bitrateBps) {
        $this->bitrateBps = $bitrateBps;
    }

    public function getBitrateBps () {
        return $this->bitrateBps;
    }

    public function setCodec ($codec) {
        $this->codec = $codec;
    }

    public function getCodec () {
        return $this->codec;
    }

    public function setFrameRateFps ($frameRateFps) {
        $this->frameRateFps = $frameRateFps;
    }

    public function getFrameRateFps () {
        return $this->frameRateFps;
    }

    public function setHeightPixels ($heightPixels) {
        $this->heightPixels = $heightPixels;
    }

    public function getHeightPixels () {
        return $this->heightPixels;
    }

    public function setRotation ($rotation) {
        $this->rotation = $rotation;
    }

    public function getRotation () {
        return $this->rotation;
    }

    public function setVendor ($vendor) {
        $this->vendor = $vendor;
    }

    public function getVendor () {
        return $this->vendor;
    }

    public function setWidthPixels ($widthPixels) {
        $this->widthPixels = $widthPixels;
    }

    public function getWidthPixels () {
        return $this->widthPixels;
    }

}

?>