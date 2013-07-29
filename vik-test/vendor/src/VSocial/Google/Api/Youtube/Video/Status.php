<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class Status
        extends Model {

    public $embeddable;
    public $failureReason;
    public $license;
    public $privacyStatus;
    public $publicStatsViewable;
    public $rejectionReason;
    public $uploadStatus;

    public function setEmbeddable ($embeddable) {
        $this->embeddable = $embeddable;
    }

    public function getEmbeddable () {
        return $this->embeddable;
    }

    public function setFailureReason ($failureReason) {
        $this->failureReason = $failureReason;
    }

    public function getFailureReason () {
        return $this->failureReason;
    }

    public function setLicense ($license) {
        $this->license = $license;
    }

    public function getLicense () {
        return $this->license;
    }

    public function setPrivacyStatus ($privacyStatus) {
        $this->privacyStatus = $privacyStatus;
    }

    public function getPrivacyStatus () {
        return $this->privacyStatus;
    }

    public function setPublicStatsViewable ($publicStatsViewable) {
        $this->publicStatsViewable = $publicStatsViewable;
    }

    public function getPublicStatsViewable () {
        return $this->publicStatsViewable;
    }

    public function setRejectionReason ($rejectionReason) {
        $this->rejectionReason = $rejectionReason;
    }

    public function getRejectionReason () {
        return $this->rejectionReason;
    }

    public function setUploadStatus ($uploadStatus) {
        $this->uploadStatus = $uploadStatus;
    }

    public function getUploadStatus () {
        return $this->uploadStatus;
    }

}

?>