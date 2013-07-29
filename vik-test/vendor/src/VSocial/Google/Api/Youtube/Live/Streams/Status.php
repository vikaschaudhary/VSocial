<?php
namespace VSocial\Google\Api\Youtube\Live\Streams;

use VSocial\Google\Service\Model;

class Status
        extends Model {

    public $streamStatus;

    public function setStreamStatus ($streamStatus) {
        $this->streamStatus = $streamStatus;
    }

    public function getStreamStatus () {
        return $this->streamStatus;
    }

}

?>
