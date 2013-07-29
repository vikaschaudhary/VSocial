<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\Model;

class VideoUrl
        extends Model {

    public $itag;
    public $url;

    public function setItag ($itag) {
        $this->itag = $itag;
    }

    public function getItag () {
        return $this->itag;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
