<?php
namespace VSocial\Google\Api\Youtube\Activity\Content\Details;

use VSocial\Google\Service\Model;

class Recommendation
        extends Model {

    public $reason;
    protected $__resourceIdType = 'Google_ResourceId';
    protected $__resourceIdDataType = '';
    public $resourceId;
    protected $__seedResourceIdType = 'Google_ResourceId';
    protected $__seedResourceIdDataType = '';
    public $seedResourceId;

    public function setReason ($reason) {
        $this->reason = $reason;
    }

    public function getReason () {
        return $this->reason;
    }

    public function setResourceId (Google_ResourceId $resourceId) {
        $this->resourceId = $resourceId;
    }

    public function getResourceId () {
        return $this->resourceId;
    }

    public function setSeedResourceId (Google_ResourceId $seedResourceId) {
        $this->seedResourceId = $seedResourceId;
    }

    public function getSeedResourceId () {
        return $this->seedResourceId;
    }

}

?>
