<?php
namespace VSocial\Google\Api\Youtube\Activity\Content\Details;

use VSocial\Google\Service\Model;

class PlaylistItem
        extends Model {

    public $playlistId;
    public $playlistItemId;
    protected $__resourceIdType = 'Google_ResourceId';
    protected $__resourceIdDataType = '';
    public $resourceId;

    public function setPlaylistId ($playlistId) {
        $this->playlistId = $playlistId;
    }

    public function getPlaylistId () {
        return $this->playlistId;
    }

    public function setPlaylistItemId ($playlistItemId) {
        $this->playlistItemId = $playlistItemId;
    }

    public function getPlaylistItemId () {
        return $this->playlistItemId;
    }

    public function setResourceId (Google_ResourceId $resourceId) {
        $this->resourceId = $resourceId;
    }

    public function getResourceId () {
        return $this->resourceId;
    }

}

?>
