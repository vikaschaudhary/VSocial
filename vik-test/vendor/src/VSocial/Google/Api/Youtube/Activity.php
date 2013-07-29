<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class Activity
        extends Model {

    protected $__contentDetailsType = '\\VSocial\Google\\Api\\Youtube\\Activity\\ContentDetails';
    protected $__contentDetailsDataType = '';
    public $contentDetails;
    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = '\VSocial\Google\\Api\\Youtube\\Activity\\Snippet';
    protected $__snippetDataType = '';
    public $snippet;

    public function setContentDetails (Activity\Content\Details $contentDetails) {
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

    public function setSnippet (Activity\Snippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

}

?>
