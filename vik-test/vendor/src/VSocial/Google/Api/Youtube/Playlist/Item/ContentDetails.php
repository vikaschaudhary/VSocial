<?php
namespace VSocial\Google\Api\Youtube\Playlist\Item;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $endAt;
    public $note;
    public $startAt;
    public $videoId;

    public function setEndAt ($endAt) {
        $this->endAt = $endAt;
    }

    public function getEndAt () {
        return $this->endAt;
    }

    public function setNote ($note) {
        $this->note = $note;
    }

    public function getNote () {
        return $this->note;
    }

    public function setStartAt ($startAt) {
        $this->startAt = $startAt;
    }

    public function getStartAt () {
        return $this->startAt;
    }

    public function setVideoId ($videoId) {
        $this->videoId = $videoId;
    }

    public function getVideoId () {
        return $this->videoId;
    }

}

?>
