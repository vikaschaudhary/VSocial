<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class ContentDetails
        extends Model {

    public $caption;
    protected $__contentRatingType = 'Google_ContentRating';
    protected $__contentRatingDataType = '';
    public $contentRating;
    protected $__countryRestrictionType = 'Google_AccessPolicy';
    protected $__countryRestrictionDataType = '';
    public $countryRestriction;
    public $definition;
    public $dimension;
    public $duration;
    public $licensedContent;
    protected $__regionRestrictionType = 'Google_VideoContentDetailsRegionRestriction';
    protected $__regionRestrictionDataType = '';
    public $regionRestriction;

    public function setCaption ($caption) {
        $this->caption = $caption;
    }

    public function getCaption () {
        return $this->caption;
    }

    public function setContentRating (Google_ContentRating $contentRating) {
        $this->contentRating = $contentRating;
    }

    public function getContentRating () {
        return $this->contentRating;
    }

    public function setCountryRestriction (Google_AccessPolicy $countryRestriction) {
        $this->countryRestriction = $countryRestriction;
    }

    public function getCountryRestriction () {
        return $this->countryRestriction;
    }

    public function setDefinition ($definition) {
        $this->definition = $definition;
    }

    public function getDefinition () {
        return $this->definition;
    }

    public function setDimension ($dimension) {
        $this->dimension = $dimension;
    }

    public function getDimension () {
        return $this->dimension;
    }

    public function setDuration ($duration) {
        $this->duration = $duration;
    }

    public function getDuration () {
        return $this->duration;
    }

    public function setLicensedContent ($licensedContent) {
        $this->licensedContent = $licensedContent;
    }

    public function getLicensedContent () {
        return $this->licensedContent;
    }

    public function setRegionRestriction (Google_VideoContentDetailsRegionRestriction $regionRestriction) {
        $this->regionRestriction = $regionRestriction;
    }

    public function getRegionRestriction () {
        return $this->regionRestriction;
    }

}

?>