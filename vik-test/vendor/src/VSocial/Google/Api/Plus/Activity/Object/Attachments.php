<?php
namespace VSocial\Google\Api\Plus\Activity\Object;

use VSocial\Google\Service\Model;

class Attachments
        extends Model {

    public $content;
    public $displayName;
    protected $__embedType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsEmbed';
    protected $__embedDataType = '';
    public $embed;
    protected $__fullImageType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsFullImage';
    protected $__fullImageDataType = '';
    public $fullImage;
    public $id;
    protected $__imageType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsImage';
    protected $__imageDataType = '';
    public $image;
    public $objectType;
    protected $__thumbnailsType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsThumbnails';
    protected $__thumbnailsDataType = 'array';
    public $thumbnails;
    public $url;

    public function setContent ($content) {
        $this->content = $content;
    }

    public function getContent () {
        return $this->content;
    }

    public function setDisplayName ($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName () {
        return $this->displayName;
    }

    public function setEmbed (AttachmentsEmbed $embed) {
        $this->embed = $embed;
    }

    public function getEmbed () {
        return $this->embed;
    }

    public function setFullImage (AttachmentsFullImage $fullImage) {
        $this->fullImage = $fullImage;
    }

    public function getFullImage () {
        return $this->fullImage;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setImage (AttachmentsImage $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setObjectType ($objectType) {
        $this->objectType = $objectType;
    }

    public function getObjectType () {
        return $this->objectType;
    }

    public function setThumbnails (/* array(Google_ActivityObjectAttachmentsThumbnails) */ $thumbnails) {
        $this->assertIsArray($thumbnails, '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\AttachmentsThumbnails', __METHOD__);
        $this->thumbnails = $thumbnails;
    }

    public function getThumbnails () {
        return $this->thumbnails;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
