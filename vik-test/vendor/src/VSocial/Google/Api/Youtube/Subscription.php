<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Subscription
        extends Model {

    protected $__contentDetailsType = 'Google_SubscriptionContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = 'Google_SubscriptionSnippet';
    protected $__snippetDataType = '';
    public $snippet;

    public function setContentDetails (Google_SubscriptionContentDetails $contentDetails) {
        $this->contentDetails = $contentDetails;
    }

    public function getContentDetails () {
        return $this->contentDetails;
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

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setSnippet (Google_SubscriptionSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

}

?>
