<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class PLayer
        extends Model {

    protected $__adsPlaylistType = '\\VSocial\\Google\\Api\Youtube\\Player\\AdsPlaylist';
    protected $__adsPlaylistDataType = '';
    public $adsPlaylist;
    public $etag;
    protected $__idType = '\\VSocial\\Google\\Api\Youtube\\ResourceId';
    protected $__idDataType = '';
    public $id;
    protected $__invideoFeatureType = '\\VSocial\\Google\\Api\Youtube\\InvideoFeature';
    protected $__invideoFeatureDataType = '';
    public $invideoFeature;
    public $kind;
    protected $__videoUrlsType = '\\VSocial\\Google\\Api\Youtube\\Player\\VideoUrls';
    protected $__videoUrlsDataType = '';
    public $videoUrls;

    public function setAdsPlaylist (Players\AdsPlaylist $adsPlaylist) {
        $this->adsPlaylist = $adsPlaylist;
    }

    public function getAdsPlaylist () {
        return $this->adsPlaylist;
    }

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setId (ResourceId $id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setInvideoFeature (InvideoFeature $invideoFeature) {
        $this->invideoFeature = $invideoFeature;
    }

    public function getInvideoFeature () {
        return $this->invideoFeature;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setVideoUrls (Players\VideoUrls $videoUrls) {
        $this->videoUrls = $videoUrls;
    }

    public function getVideoUrls () {
        return $this->videoUrls;
    }

}

?>
