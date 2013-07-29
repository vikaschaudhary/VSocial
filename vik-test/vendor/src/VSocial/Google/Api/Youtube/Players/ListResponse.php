<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\Model;

class ListResponse
        extends Model {

    public $etag;
    public $kind;
    protected $__playersType = 'Google_Player';
    protected $__playersDataType = 'array';
    public $players;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setPlayers (/* array(Google_Player) */ $players) {
        $this->assertIsArray($players, 'Google_Player', __METHOD__);
        $this->players = $players;
    }

    public function getPlayers () {
        return $this->players;
    }

}

?>
