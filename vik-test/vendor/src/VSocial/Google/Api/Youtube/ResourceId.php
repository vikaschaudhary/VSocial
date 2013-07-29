<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class ResourceId
        extends Model {

    public $channelId;
    public $kind;
    public $playlistId;
    public $videoId;

    public function setChannelId ($channelId) {
        $this->channelId = $channelId;
    }

    public function getChannelId () {
        return $this->channelId;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setPlaylistId ($playlistId) {
        $this->playlistId = $playlistId;
    }

    public function getPlaylistId () {
        return $this->playlistId;
    }

    public function setVideoId ($videoId) {
        $this->videoId = $videoId;
    }

    public function getVideoId () {
        return $this->videoId;
    }

}

?>
