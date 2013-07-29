<?php
namespace VSocial\Google\Api\Youtube\Channels;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $googlePlusUserId;
    protected $__relatedPlaylistsType = 'Google_ChannelContentDetailsRelatedPlaylists';
    protected $__relatedPlaylistsDataType = '';
    public $relatedPlaylists;

    public function setGooglePlusUserId ($googlePlusUserId) {
        $this->googlePlusUserId = $googlePlusUserId;
    }

    public function getGooglePlusUserId () {
        return $this->googlePlusUserId;
    }

    public function setRelatedPlaylists (Google_ChannelContentDetailsRelatedPlaylists $relatedPlaylists) {
        $this->relatedPlaylists = $relatedPlaylists;
    }

    public function getRelatedPlaylists () {
        return $this->relatedPlaylists;
    }

}

?>
