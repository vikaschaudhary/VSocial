<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class Person
        extends Model {

    public $aboutMe;
    protected $__ageRangeType = '\\VSocial\\Google\\Api\\Plus\\Person\\AgeRange';
    protected $__ageRangeDataType = '';
    public $ageRange;
    public $birthday;
    public $braggingRights;
    public $circledByCount;
    protected $__coverType = '\\VSocial\\Google\\Api\\Plus\\Person\\Cover';
    protected $__coverDataType = '';
    public $cover;
    public $currentLocation;
    public $displayName;
    protected $__emailsType = '\\VSocial\\Google\\Api\\Plus\\Person\\Emails';
    protected $__emailsDataType = 'array';
    public $emails;
    public $etag;
    public $gender;
    public $hasApp;
    public $id;
    protected $__imageType = '\\VSocial\\Google\\Api\\Plus\\Person\\Image';
    protected $__imageDataType = '';
    public $image;
    public $isPlusUser;
    public $kind;
    public $language;
    protected $__nameType = '\\VSocial\\Google\\Api\\Plus\\Person\\Name';
    protected $__nameDataType = '';
    public $name;
    public $nickname;
    public $objectType;
    protected $__organizationsType = '\\VSocial\\Google\\Api\\Plus\\Person\\Organizations';
    protected $__organizationsDataType = 'array';
    public $organizations;
    protected $__placesLivedType = '\\VSocial\\Google\\Api\\Plus\\Person\\PlacesLived';
    protected $__placesLivedDataType = 'array';
    public $placesLived;
    public $plusOneCount;
    public $relationshipStatus;
    public $tagline;
    public $url;
    protected $__urlsType = '\\VSocial\\Google\\Api\\Plus\\Person\\Urls';
    protected $__urlsDataType = 'array';
    public $urls;
    public $verified;

    public function setAboutMe ($aboutMe) {
        $this->aboutMe = $aboutMe;
    }

    public function getAboutMe () {
        return $this->aboutMe;
    }

    public function setAgeRange (Person\AgeRange $ageRange) {
        $this->ageRange = $ageRange;
    }

    public function getAgeRange () {
        return $this->ageRange;
    }

    public function setBirthday ($birthday) {
        $this->birthday = $birthday;
    }

    public function getBirthday () {
        return $this->birthday;
    }

    public function setBraggingRights ($braggingRights) {
        $this->braggingRights = $braggingRights;
    }

    public function getBraggingRights () {
        return $this->braggingRights;
    }

    public function setCircledByCount ($circledByCount) {
        $this->circledByCount = $circledByCount;
    }

    public function getCircledByCount () {
        return $this->circledByCount;
    }

    public function setCover (Person\Cover $cover) {
        $this->cover = $cover;
    }

    public function getCover () {
        return $this->cover;
    }

    public function setCurrentLocation ($currentLocation) {
        $this->currentLocation = $currentLocation;
    }

    public function getCurrentLocation () {
        return $this->currentLocation;
    }

    public function setDisplayName ($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName () {
        return $this->displayName;
    }

    public function setEmails (/* array(Google_PersonEmails) */ $emails) {
        $this->assertIsArray($emails, '\\VSocial\\Google\\Api\\Plus\\Person\\Emails', __METHOD__);
        $this->emails = $emails;
    }

    public function getEmails () {
        return $this->emails;
    }

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setGender ($gender) {
        $this->gender = $gender;
    }

    public function getGender () {
        return $this->gender;
    }

    public function setHasApp ($hasApp) {
        $this->hasApp = $hasApp;
    }

    public function getHasApp () {
        return $this->hasApp;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setImage (Person\Image $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setIsPlusUser ($isPlusUser) {
        $this->isPlusUser = $isPlusUser;
    }

    public function getIsPlusUser () {
        return $this->isPlusUser;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setLanguage ($language) {
        $this->language = $language;
    }

    public function getLanguage () {
        return $this->language;
    }

    public function setName (Person\Name $name) {
        $this->name = $name;
    }

    public function getName () {
        return $this->name;
    }

    public function setNickname ($nickname) {
        $this->nickname = $nickname;
    }

    public function getNickname () {
        return $this->nickname;
    }

    public function setObjectType ($objectType) {
        $this->objectType = $objectType;
    }

    public function getObjectType () {
        return $this->objectType;
    }

    public function setOrganizations (/* array(Google_PersonOrganizations) */ $organizations) {
        $this->assertIsArray($organizations, '\\VSocial\\Google\\Api\\Plus\\Person\\Organizations', __METHOD__);
        $this->organizations = $organizations;
    }

    public function getOrganizations () {
        return $this->organizations;
    }

    public function setPlacesLived (/* array(Google_PersonPlacesLived) */ $placesLived) {
        $this->assertIsArray($placesLived, '\\VSocial\\Google\\Api\\Plus\\Person\\PlacesLived', __METHOD__);
        $this->placesLived = $placesLived;
    }

    public function getPlacesLived () {
        return $this->placesLived;
    }

    public function setPlusOneCount ($plusOneCount) {
        $this->plusOneCount = $plusOneCount;
    }

    public function getPlusOneCount () {
        return $this->plusOneCount;
    }

    public function setRelationshipStatus ($relationshipStatus) {
        $this->relationshipStatus = $relationshipStatus;
    }

    public function getRelationshipStatus () {
        return $this->relationshipStatus;
    }

    public function setTagline ($tagline) {
        $this->tagline = $tagline;
    }

    public function getTagline () {
        return $this->tagline;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

    public function setUrls (/* array(Google_PersonUrls) */ $urls) {
        $this->assertIsArray($urls, '\\VSocial\\Google\\Api\\Plus\\Person\\Urls', __METHOD__);
        $this->urls = $urls;
    }

    public function getUrls () {
        return $this->urls;
    }

    public function setVerified ($verified) {
        $this->verified = $verified;
    }

    public function getVerified () {
        return $this->verified;
    }

}

?>
