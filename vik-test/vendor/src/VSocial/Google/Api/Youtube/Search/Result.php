<?php
namespace VSocial\Google\Api\Youtube\Search;

use VSocial\Google\Service\Model;

class Result
        extends Model {

    public $etag;
    protected $__idType = 'Google_ResourceId';
    protected $__idDataType = '';
    public $id;
    public $kind;
    protected $__snippetType = 'Google_SearchResultSnippet';
    protected $__snippetDataType = '';
    public $snippet;

    public function setEtag ($etag) {
        $this->etag = $etag;
    }

    public function getEtag () {
        return $this->etag;
    }

    public function setId (Google_ResourceId $id) {
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

    public function setSnippet (Google_SearchResultSnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

}

?>
