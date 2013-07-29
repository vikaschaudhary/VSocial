<?php
namespace VSocial\Google\Api\Youtube\Channels;

use VSocial\Google\Service\Model;

class ContentDetailsRelatedPlaylists
        extends Model {

    public $favorites;
    public $likes;
    public $uploads;
    public $watchHistory;
    public $watchLater;

    public function setFavorites ($favorites) {
        $this->favorites = $favorites;
    }

    public function getFavorites () {
        return $this->favorites;
    }

    public function setLikes ($likes) {
        $this->likes = $likes;
    }

    public function getLikes () {
        return $this->likes;
    }

    public function setUploads ($uploads) {
        $this->uploads = $uploads;
    }

    public function getUploads () {
        return $this->uploads;
    }

    public function setWatchHistory ($watchHistory) {
        $this->watchHistory = $watchHistory;
    }

    public function getWatchHistory () {
        return $this->watchHistory;
    }

    public function setWatchLater ($watchLater) {
        $this->watchLater = $watchLater;
    }

    public function getWatchLater () {
        return $this->watchLater;
    }

}

?>
