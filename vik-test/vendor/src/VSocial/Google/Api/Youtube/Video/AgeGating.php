<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class AgeGating
        extends Model {

    public $alcoholContent;
    public $restricted;
    public $videoGameRating;

    public function setAlcoholContent ($alcoholContent) {
        $this->alcoholContent = $alcoholContent;
    }

    public function getAlcoholContent () {
        return $this->alcoholContent;
    }

    public function setRestricted ($restricted) {
        $this->restricted = $restricted;
    }

    public function getRestricted () {
        return $this->restricted;
    }

    public function setVideoGameRating ($videoGameRating) {
        $this->videoGameRating = $videoGameRating;
    }

    public function getVideoGameRating () {
        return $this->videoGameRating;
    }

}

?>
