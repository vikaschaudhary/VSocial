<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\Model;

class Status
        extends Model {

    public $privacyStatus;

    public function setPrivacyStatus ($privacyStatus) {
        $this->privacyStatus = $privacyStatus;
    }

    public function getPrivacyStatus () {
        return $this->privacyStatus;
    }

}

?>
