<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\Model;

class Player
        extends Model {

    public $embedHtml;

    public function setEmbedHtml ($embedHtml) {
        $this->embedHtml = $embedHtml;
    }

    public function getEmbedHtml () {
        return $this->embedHtml;
    }

}

?>
