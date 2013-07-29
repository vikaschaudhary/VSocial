<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\Model;

class AdsPlaylist
        extends Model {

    public $vmap_xml;

    public function setVmap_xml ($vmap_xml) {
        $this->vmap_xml = $vmap_xml;
    }

    public function getVmap_xml () {
        return $this->vmap_xml;
    }

}


?>
