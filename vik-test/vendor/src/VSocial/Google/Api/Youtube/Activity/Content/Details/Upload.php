<?php
namespace VSocial\Google\Api\Youtube\Activity\Content\Details;

use VSocial\Google\Service\Model;

class Upload
        extends Model {

    public $videoId;

    public function setVideoId ($videoId) {
        $this->videoId = $videoId;
    }

    public function getVideoId () {
        return $this->videoId;
    }

}

?>
