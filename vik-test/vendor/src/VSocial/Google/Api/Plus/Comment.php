<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class Comment
        extends Model {

    protected $__actorType = 'Google_CommentActor';
    protected $__actorDataType = '';
    public $actor;
    public $etag;
    public $id;
    protected $__inReplyToType = 'Google_CommentInReplyTo';
    protected $__inReplyToDataType = 'array';
    public $inReplyTo;
    public $kind;
    protected $__objectType = 'Google_CommentObject';
    protected $__objectDataType = '';
    public $object;
    protected $__plusonersType = 'Google_CommentPlusoners';
    protected $__plusonersDataType = '';
    public $plusoners;
    public $published;
    public $selfLink;
    public $updated;
    public $verb;

    public function setActor (Google_CommentActor $actor) {
        $this->actor = $actor;
    }

    public function getActor () {
        return $this->actor;
    }

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setInReplyTo (/* array(Google_CommentInReplyTo) */ $inReplyTo) {
        $this->assertIsArray($inReplyTo, 'Google_CommentInReplyTo', __METHOD__);
        $this->inReplyTo = $inReplyTo;
    }

    public function getInReplyTo () {
        return $this->inReplyTo;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setObject (Google_CommentObject $object) {
        $this->object = $object;
    }

    public function getObject () {
        return $this->object;
    }

    public function setPlusoners (Google_CommentPlusoners $plusoners) {
        $this->plusoners = $plusoners;
    }

    public function getPlusoners () {
        return $this->plusoners;
    }

    public function setPublished ($published) {
        $this->published = $published;
    }

    public function getPublished () {
        return $this->published;
    }

    public function setSelfLink ($selfLink) {
        $this->selfLink = $selfLink;
    }

    public function getSelfLink () {
        return $this->selfLink;
    }

    public function setUpdated ($updated) {
        $this->updated = $updated;
    }

    public function getUpdated () {
        return $this->updated;
    }

    public function setVerb ($verb) {
        $this->verb = $verb;
    }

    public function getVerb () {
        return $this->verb;
    }

}

?>
