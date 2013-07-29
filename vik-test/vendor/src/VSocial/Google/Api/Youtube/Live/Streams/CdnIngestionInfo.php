<?php
namespace VSocial\Google\Api\Youtube\Live\Streams;

use VSocial\Google\Service\Model;

class CdnIngestionInfo
        extends Model {

    public $backupIngestionAddress;
    public $ingestionAddress;
    public $streamName;

    public function setBackupIngestionAddress ($backupIngestionAddress) {
        $this->backupIngestionAddress = $backupIngestionAddress;
    }

    public function getBackupIngestionAddress () {
        return $this->backupIngestionAddress;
    }

    public function setIngestionAddress ($ingestionAddress) {
        $this->ingestionAddress = $ingestionAddress;
    }

    public function getIngestionAddress () {
        return $this->ingestionAddress;
    }

    public function setStreamName ($streamName) {
        $this->streamName = $streamName;
    }

    public function getStreamName () {
        return $this->streamName;
    }

}

?>
