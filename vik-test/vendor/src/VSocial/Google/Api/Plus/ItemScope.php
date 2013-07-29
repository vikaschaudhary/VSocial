<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class ItemScope
        extends Model {

    protected $__aboutType = 'Google_ItemScope';
    protected $__aboutDataType = '';
    public $about;
    public $additionalName;
    protected $__addressType = 'Google_ItemScope';
    protected $__addressDataType = '';
    public $address;
    public $addressCountry;
    public $addressLocality;
    public $addressRegion;
    protected $__associated_mediaType = 'Google_ItemScope';
    protected $__associated_mediaDataType = 'array';
    public $associated_media;
    public $attendeeCount;
    protected $__attendeesType = 'Google_ItemScope';
    protected $__attendeesDataType = 'array';
    public $attendees;
    protected $__audioType = 'Google_ItemScope';
    protected $__audioDataType = '';
    public $audio;
    protected $__authorType = 'Google_ItemScope';
    protected $__authorDataType = 'array';
    public $author;
    public $bestRating;
    public $birthDate;
    protected $__byArtistType = 'Google_ItemScope';
    protected $__byArtistDataType = '';
    public $byArtist;
    public $caption;
    public $contentSize;
    public $contentUrl;
    protected $__contributorType = 'Google_ItemScope';
    protected $__contributorDataType = 'array';
    public $contributor;
    public $dateCreated;
    public $dateModified;
    public $datePublished;
    public $description;
    public $duration;
    public $embedUrl;
    public $endDate;
    public $familyName;
    public $gender;
    protected $__geoType = 'Google_ItemScope';
    protected $__geoDataType = '';
    public $geo;
    public $givenName;
    public $height;
    public $id;
    public $image;
    protected $__inAlbumType = 'Google_ItemScope';
    protected $__inAlbumDataType = '';
    public $inAlbum;
    public $kind;
    public $latitude;
    protected $__locationType = 'Google_ItemScope';
    protected $__locationDataType = '';
    public $location;
    public $longitude;
    public $name;
    protected $__partOfTVSeriesType = 'Google_ItemScope';
    protected $__partOfTVSeriesDataType = '';
    public $partOfTVSeries;
    protected $__performersType = 'Google_ItemScope';
    protected $__performersDataType = 'array';
    public $performers;
    public $playerType;
    public $postOfficeBoxNumber;
    public $postalCode;
    public $ratingValue;
    protected $__reviewRatingType = 'Google_ItemScope';
    protected $__reviewRatingDataType = '';
    public $reviewRating;
    public $startDate;
    public $streetAddress;
    public $text;
    protected $__thumbnailType = 'Google_ItemScope';
    protected $__thumbnailDataType = '';
    public $thumbnail;
    public $thumbnailUrl;
    public $tickerSymbol;
    public $type;
    public $url;
    public $width;
    public $worstRating;

    public function setAbout (Google_ItemScope $about) {
        $this->about = $about;
    }

    public function getAbout () {
        return $this->about;
    }

    public function setAdditionalName (/* array(Google_string) */ $additionalName) {
        $this->assertIsArray($additionalName, 'Google_string', __METHOD__);
        $this->additionalName = $additionalName;
    }

    public function getAdditionalName () {
        return $this->additionalName;
    }

    public function setAddress (Google_ItemScope $address) {
        $this->address = $address;
    }

    public function getAddress () {
        return $this->address;
    }

    public function setAddressCountry ($addressCountry) {
        $this->addressCountry = $addressCountry;
    }

    public function getAddressCountry () {
        return $this->addressCountry;
    }

    public function setAddressLocality ($addressLocality) {
        $this->addressLocality = $addressLocality;
    }

    public function getAddressLocality () {
        return $this->addressLocality;
    }

    public function setAddressRegion ($addressRegion) {
        $this->addressRegion = $addressRegion;
    }

    public function getAddressRegion () {
        return $this->addressRegion;
    }

    public function setAssociated_media (/* array(Google_ItemScope) */ $associated_media) {
        $this->assertIsArray($associated_media, 'Google_ItemScope', __METHOD__);
        $this->associated_media = $associated_media;
    }

    public function getAssociated_media () {
        return $this->associated_media;
    }

    public function setAttendeeCount ($attendeeCount) {
        $this->attendeeCount = $attendeeCount;
    }

    public function getAttendeeCount () {
        return $this->attendeeCount;
    }

    public function setAttendees (/* array(Google_ItemScope) */ $attendees) {
        $this->assertIsArray($attendees, 'Google_ItemScope', __METHOD__);
        $this->attendees = $attendees;
    }

    public function getAttendees () {
        return $this->attendees;
    }

    public function setAudio (Google_ItemScope $audio) {
        $this->audio = $audio;
    }

    public function getAudio () {
        return $this->audio;
    }

    public function setAuthor (/* array(Google_ItemScope) */ $author) {
        $this->assertIsArray($author, 'Google_ItemScope', __METHOD__);
        $this->author = $author;
    }

    public function getAuthor () {
        return $this->author;
    }

    public function setBestRating ($bestRating) {
        $this->bestRating = $bestRating;
    }

    public function getBestRating () {
        return $this->bestRating;
    }

    public function setBirthDate ($birthDate) {
        $this->birthDate = $birthDate;
    }

    public function getBirthDate () {
        return $this->birthDate;
    }

    public function setByArtist (Google_ItemScope $byArtist) {
        $this->byArtist = $byArtist;
    }

    public function getByArtist () {
        return $this->byArtist;
    }

    public function setCaption ($caption) {
        $this->caption = $caption;
    }

    public function getCaption () {
        return $this->caption;
    }

    public function setContentSize ($contentSize) {
        $this->contentSize = $contentSize;
    }

    public function getContentSize () {
        return $this->contentSize;
    }

    public function setContentUrl ($contentUrl) {
        $this->contentUrl = $contentUrl;
    }

    public function getContentUrl () {
        return $this->contentUrl;
    }

    public function setContributor (/* array(Google_ItemScope) */ $contributor) {
        $this->assertIsArray($contributor, 'Google_ItemScope', __METHOD__);
        $this->contributor = $contributor;
    }

    public function getContributor () {
        return $this->contributor;
    }

    public function setDateCreated ($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    public function getDateCreated () {
        return $this->dateCreated;
    }

    public function setDateModified ($dateModified) {
        $this->dateModified = $dateModified;
    }

    public function getDateModified () {
        return $this->dateModified;
    }

    public function setDatePublished ($datePublished) {
        $this->datePublished = $datePublished;
    }

    public function getDatePublished () {
        return $this->datePublished;
    }

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setDuration ($duration) {
        $this->duration = $duration;
    }

    public function getDuration () {
        return $this->duration;
    }

    public function setEmbedUrl ($embedUrl) {
        $this->embedUrl = $embedUrl;
    }

    public function getEmbedUrl () {
        return $this->embedUrl;
    }

    public function setEndDate ($endDate) {
        $this->endDate = $endDate;
    }

    public function getEndDate () {
        return $this->endDate;
    }

    public function setFamilyName ($familyName) {
        $this->familyName = $familyName;
    }

    public function getFamilyName () {
        return $this->familyName;
    }

    public function setGender ($gender) {
        $this->gender = $gender;
    }

    public function getGender () {
        return $this->gender;
    }

    public function setGeo (Google_ItemScope $geo) {
        $this->geo = $geo;
    }

    public function getGeo () {
        return $this->geo;
    }

    public function setGivenName ($givenName) {
        $this->givenName = $givenName;
    }

    public function getGivenName () {
        return $this->givenName;
    }

    public function setHeight ($height) {
        $this->height = $height;
    }

    public function getHeight () {
        return $this->height;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setImage ($image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setInAlbum (Google_ItemScope $inAlbum) {
        $this->inAlbum = $inAlbum;
    }

    public function getInAlbum () {
        return $this->inAlbum;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setLatitude ($latitude) {
        $this->latitude = $latitude;
    }

    public function getLatitude () {
        return $this->latitude;
    }

    public function setLocation (Google_ItemScope $location) {
        $this->location = $location;
    }

    public function getLocation () {
        return $this->location;
    }

    public function setLongitude ($longitude) {
        $this->longitude = $longitude;
    }

    public function getLongitude () {
        return $this->longitude;
    }

    public function setName ($name) {
        $this->name = $name;
    }

    public function getName () {
        return $this->name;
    }

    public function setPartOfTVSeries (Google_ItemScope $partOfTVSeries) {
        $this->partOfTVSeries = $partOfTVSeries;
    }

    public function getPartOfTVSeries () {
        return $this->partOfTVSeries;
    }

    public function setPerformers (/* array(Google_ItemScope) */ $performers) {
        $this->assertIsArray($performers, 'Google_ItemScope', __METHOD__);
        $this->performers = $performers;
    }

    public function getPerformers () {
        return $this->performers;
    }

    public function setPlayerType ($playerType) {
        $this->playerType = $playerType;
    }

    public function getPlayerType () {
        return $this->playerType;
    }

    public function setPostOfficeBoxNumber ($postOfficeBoxNumber) {
        $this->postOfficeBoxNumber = $postOfficeBoxNumber;
    }

    public function getPostOfficeBoxNumber () {
        return $this->postOfficeBoxNumber;
    }

    public function setPostalCode ($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode () {
        return $this->postalCode;
    }

    public function setRatingValue ($ratingValue) {
        $this->ratingValue = $ratingValue;
    }

    public function getRatingValue () {
        return $this->ratingValue;
    }

    public function setReviewRating (Google_ItemScope $reviewRating) {
        $this->reviewRating = $reviewRating;
    }

    public function getReviewRating () {
        return $this->reviewRating;
    }

    public function setStartDate ($startDate) {
        $this->startDate = $startDate;
    }

    public function getStartDate () {
        return $this->startDate;
    }

    public function setStreetAddress ($streetAddress) {
        $this->streetAddress = $streetAddress;
    }

    public function getStreetAddress () {
        return $this->streetAddress;
    }

    public function setText ($text) {
        $this->text = $text;
    }

    public function getText () {
        return $this->text;
    }

    public function setThumbnail (Google_ItemScope $thumbnail) {
        $this->thumbnail = $thumbnail;
    }

    public function getThumbnail () {
        return $this->thumbnail;
    }

    public function setThumbnailUrl ($thumbnailUrl) {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function getThumbnailUrl () {
        return $this->thumbnailUrl;
    }

    public function setTickerSymbol ($tickerSymbol) {
        $this->tickerSymbol = $tickerSymbol;
    }

    public function getTickerSymbol () {
        return $this->tickerSymbol;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

    public function setWidth ($width) {
        $this->width = $width;
    }

    public function getWidth () {
        return $this->width;
    }

    public function setWorstRating ($worstRating) {
        $this->worstRating = $worstRating;
    }

    public function getWorstRating () {
        return $this->worstRating;
    }

}

?>
