<?php
namespace VSocial\Google\Api\Plus\Activity;

use VSocial\Google\Service\Model;

class Object
        extends Model {

    protected $__actorType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Actor';
    protected $__actorDataType = '';
    public $actor;
    protected $__attachmentsType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Attachments';
    protected $__attachmentsDataType = 'array';
    public $attachments;
    public $content;
    public $id;
    public $objectType;
    public $originalContent;
    protected $__plusonersType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Plusoners';
    protected $__plusonersDataType = '';
    public $plusoners;
    protected $__repliesType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Replies';
    protected $__repliesDataType = '';
    public $replies;
    protected $__resharersType = '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Resharers';
    protected $__resharersDataType = '';
    public $resharers;
    public $url;

    public function setActor (Object\Actor $actor) {
        $this->actor = $actor;
    }

    public function getActor () {
        return $this->actor;
    }

    public function setAttachments (/* array(Google_ActivityObjectAttachments) */ $attachments) {
        $this->assertIsArray($attachments, '\\VSocial\\Google\\Api\\Plus\\Activity\\Object\\Attachments', __METHOD__);
        $this->attachments = $attachments;
    }

    public function getAttachments () {
        return $this->attachments;
    }

    public function setContent ($content) {
        $this->content = $content;
    }

    public function getContent () {
        return $this->content;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setObjectType ($objectType) {
        $this->objectType = $objectType;
    }

    public function getObjectType () {
        return $this->objectType;
    }

    public function setOriginalContent ($originalContent) {
        $this->originalContent = $originalContent;
    }

    public function getOriginalContent () {
        return $this->originalContent;
    }

    public function setPlusoners (Object\Plusoners $plusoners) {
        $this->plusoners = $plusoners;
    }

    public function getPlusoners () {
        return $this->plusoners;
    }

    public function setReplies (Object\Replies $replies) {
        $this->replies = $replies;
    }

    public function getReplies () {
        return $this->replies;
    }

    public function setResharers (Object\Resharers $resharers) {
        $this->resharers = $resharers;
    }

    public function getResharers () {
        return $this->resharers;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
