<?php
namespace VSocial\Google\Api\Youtube\Activity\Content\Details;

use VSocial\Google\Service\Model;

class ChannelItem
        extends Model {

    protected $__resourceIdType = 'Google_ResourceId';
    protected $__resourceIdDataType = '';
    public $resourceId;

    public function setResourceId (Google_ResourceId $resourceId) {
        $this->resourceId = $resourceId;
    }

    public function getResourceId () {
        return $this->resourceId;
    }

}

?>
