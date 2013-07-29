<?php
namespace VSocial\Google\Api\Youtube\Activity\Content\Details;

use VSocial\Google\Service\Model;

class Social
        extends Model {

    public $author;
    public $imageUrl;
    public $referenceUrl;
    protected $__resourceIdType = 'Google_ResourceId';
    protected $__resourceIdDataType = '';
    public $resourceId;
    public $type;

    public function setAuthor ($author) {
        $this->author = $author;
    }

    public function getAuthor () {
        return $this->author;
    }

    public function setImageUrl ($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    public function getImageUrl () {
        return $this->imageUrl;
    }

    public function setReferenceUrl ($referenceUrl) {
        $this->referenceUrl = $referenceUrl;
    }

    public function getReferenceUrl () {
        return $this->referenceUrl;
    }

    public function setResourceId (Google_ResourceId $resourceId) {
        $this->resourceId = $resourceId;
    }

    public function getResourceId () {
        return $this->resourceId;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

}

?>
