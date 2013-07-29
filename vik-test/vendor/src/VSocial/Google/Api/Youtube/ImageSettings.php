<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class ImageSettings
        extends Model {

    protected $__backgroundImageUrlType = '\\VSocial\\Google\\Api\Youtube\\LocalizedProperty';
    protected $__backgroundImageUrlDataType = '';
    public $backgroundImageUrl;
    public $bannerImageUrl;
    public $bannerMobileExtraHdImageUrl;
    public $bannerMobileHdImageUrl;
    public $bannerMobileImageUrl;
    public $bannerMobileLowImageUrl;
    public $bannerMobileMediumHdImageUrl;
    public $bannerTabletExtraHdImageUrl;
    public $bannerTabletHdImageUrl;
    public $bannerTabletImageUrl;
    public $bannerTabletLowImageUrl;
    public $bannerTvImageUrl;
    protected $__largeBrandedBannerImageImapScriptType = '\\VSocial\\Google\\Api\Youtube\\LocalizedProperty';
    protected $__largeBrandedBannerImageImapScriptDataType = '';
    public $largeBrandedBannerImageImapScript;
    protected $__largeBrandedBannerImageUrlType = '\\VSocial\\Google\\Api\Youtube\\LocalizedProperty';
    protected $__largeBrandedBannerImageUrlDataType = '';
    public $largeBrandedBannerImageUrl;
    protected $__smallBrandedBannerImageImapScriptType = '\\VSocial\\Google\\Api\Youtube\\LocalizedProperty';
    protected $__smallBrandedBannerImageImapScriptDataType = '';
    public $smallBrandedBannerImageImapScript;
    protected $__smallBrandedBannerImageUrlType = '\\VSocial\\Google\\Api\Youtube\\LocalizedProperty';
    protected $__smallBrandedBannerImageUrlDataType = '';
    public $smallBrandedBannerImageUrl;
    public $trackingImageUrl;
    public $watchIconImageUrl;

    public function setBackgroundImageUrl (LocalizedProperty $backgroundImageUrl) {
        $this->backgroundImageUrl = $backgroundImageUrl;
    }

    public function getBackgroundImageUrl () {
        return $this->backgroundImageUrl;
    }

    public function setBannerImageUrl ($bannerImageUrl) {
        $this->bannerImageUrl = $bannerImageUrl;
    }

    public function getBannerImageUrl () {
        return $this->bannerImageUrl;
    }

    public function setBannerMobileExtraHdImageUrl ($bannerMobileExtraHdImageUrl) {
        $this->bannerMobileExtraHdImageUrl = $bannerMobileExtraHdImageUrl;
    }

    public function getBannerMobileExtraHdImageUrl () {
        return $this->bannerMobileExtraHdImageUrl;
    }

    public function setBannerMobileHdImageUrl ($bannerMobileHdImageUrl) {
        $this->bannerMobileHdImageUrl = $bannerMobileHdImageUrl;
    }

    public function getBannerMobileHdImageUrl () {
        return $this->bannerMobileHdImageUrl;
    }

    public function setBannerMobileImageUrl ($bannerMobileImageUrl) {
        $this->bannerMobileImageUrl = $bannerMobileImageUrl;
    }

    public function getBannerMobileImageUrl () {
        return $this->bannerMobileImageUrl;
    }

    public function setBannerMobileLowImageUrl ($bannerMobileLowImageUrl) {
        $this->bannerMobileLowImageUrl = $bannerMobileLowImageUrl;
    }

    public function getBannerMobileLowImageUrl () {
        return $this->bannerMobileLowImageUrl;
    }

    public function setBannerMobileMediumHdImageUrl ($bannerMobileMediumHdImageUrl) {
        $this->bannerMobileMediumHdImageUrl = $bannerMobileMediumHdImageUrl;
    }

    public function getBannerMobileMediumHdImageUrl () {
        return $this->bannerMobileMediumHdImageUrl;
    }

    public function setBannerTabletExtraHdImageUrl ($bannerTabletExtraHdImageUrl) {
        $this->bannerTabletExtraHdImageUrl = $bannerTabletExtraHdImageUrl;
    }

    public function getBannerTabletExtraHdImageUrl () {
        return $this->bannerTabletExtraHdImageUrl;
    }

    public function setBannerTabletHdImageUrl ($bannerTabletHdImageUrl) {
        $this->bannerTabletHdImageUrl = $bannerTabletHdImageUrl;
    }

    public function getBannerTabletHdImageUrl () {
        return $this->bannerTabletHdImageUrl;
    }

    public function setBannerTabletImageUrl ($bannerTabletImageUrl) {
        $this->bannerTabletImageUrl = $bannerTabletImageUrl;
    }

    public function getBannerTabletImageUrl () {
        return $this->bannerTabletImageUrl;
    }

    public function setBannerTabletLowImageUrl ($bannerTabletLowImageUrl) {
        $this->bannerTabletLowImageUrl = $bannerTabletLowImageUrl;
    }

    public function getBannerTabletLowImageUrl () {
        return $this->bannerTabletLowImageUrl;
    }

    public function setBannerTvImageUrl ($bannerTvImageUrl) {
        $this->bannerTvImageUrl = $bannerTvImageUrl;
    }

    public function getBannerTvImageUrl () {
        return $this->bannerTvImageUrl;
    }

    public function setLargeBrandedBannerImageImapScript (LocalizedProperty $largeBrandedBannerImageImapScript) {
        $this->largeBrandedBannerImageImapScript = $largeBrandedBannerImageImapScript;
    }

    public function getLargeBrandedBannerImageImapScript () {
        return $this->largeBrandedBannerImageImapScript;
    }

    public function setLargeBrandedBannerImageUrl (LocalizedProperty $largeBrandedBannerImageUrl) {
        $this->largeBrandedBannerImageUrl = $largeBrandedBannerImageUrl;
    }

    public function getLargeBrandedBannerImageUrl () {
        return $this->largeBrandedBannerImageUrl;
    }

    public function setSmallBrandedBannerImageImapScript (LocalizedProperty $smallBrandedBannerImageImapScript) {
        $this->smallBrandedBannerImageImapScript = $smallBrandedBannerImageImapScript;
    }

    public function getSmallBrandedBannerImageImapScript () {
        return $this->smallBrandedBannerImageImapScript;
    }

    public function setSmallBrandedBannerImageUrl (LocalizedProperty $smallBrandedBannerImageUrl) {
        $this->smallBrandedBannerImageUrl = $smallBrandedBannerImageUrl;
    }

    public function getSmallBrandedBannerImageUrl () {
        return $this->smallBrandedBannerImageUrl;
    }

    public function setTrackingImageUrl ($trackingImageUrl) {
        $this->trackingImageUrl = $trackingImageUrl;
    }

    public function getTrackingImageUrl () {
        return $this->trackingImageUrl;
    }

    public function setWatchIconImageUrl ($watchIconImageUrl) {
        $this->watchIconImageUrl = $watchIconImageUrl;
    }

    public function getWatchIconImageUrl () {
        return $this->watchIconImageUrl;
    }

}

?>
