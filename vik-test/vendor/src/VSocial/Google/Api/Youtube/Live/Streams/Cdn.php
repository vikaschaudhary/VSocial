<?php
namespace VSocial\Google\Api\Youtube\Live\Streams;

use VSocial\Google\Service\Model;

class Cdn
        extends Model {

    public $format;
    protected $__ingestionInfoType = 'Google_LiveStreamCdnIngestionInfo';
    protected $__ingestionInfoDataType = '';
    public $ingestionInfo;
    public $ingestionType;

    public function setFormat ($format) {
        $this->format = $format;
    }

    public function getFormat () {
        return $this->format;
    }

    public function setIngestionInfo (Google_LiveStreamCdnIngestionInfo $ingestionInfo) {
        $this->ingestionInfo = $ingestionInfo;
    }

    public function getIngestionInfo () {
        return $this->ingestionInfo;
    }

    public function setIngestionType ($ingestionType) {
        $this->ingestionType = $ingestionType;
    }

    public function getIngestionType () {
        return $this->ingestionType;
    }

}

?>
