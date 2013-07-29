<?php

namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;

class AttachmentsThumbnails
        extends Model {

    public $description;
    protected $__imageType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsThumbnailsImage';
    protected $__imageDataType = '';
    public $image;
    public $url;

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setImage (AttachmentsThumbnailsImage $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
