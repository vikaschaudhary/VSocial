<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class WatchSettings
        extends Model {

    public $backgroundColor;
    public $featuredPlaylistId;
    public $textColor;

    public function setBackgroundColor ($backgroundColor) {
        $this->backgroundColor = $backgroundColor;
    }

    public function getBackgroundColor () {
        return $this->backgroundColor;
    }

    public function setFeaturedPlaylistId ($featuredPlaylistId) {
        $this->featuredPlaylistId = $featuredPlaylistId;
    }

    public function getFeaturedPlaylistId () {
        return $this->featuredPlaylistId;
    }

    public function setTextColor ($textColor) {
        $this->textColor = $textColor;
    }

    public function getTextColor () {
        return $this->textColor;
    }

}

?>
