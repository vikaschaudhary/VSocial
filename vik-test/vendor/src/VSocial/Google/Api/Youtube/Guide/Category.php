<?php
namespace VSocial\Google\Api\Youtube\Guide;

use VSocial\Google\Service\Model;

class Category
        extends Model {

    public $etag;
    public $id;
    public $kind;
    protected $__snippetType = 'Google_GuideCategorySnippet';
    protected $__snippetDataType = '';
    public $snippet;

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

    public function setSnippet (Google_GuideCategorySnippet $snippet) {
        $this->snippet = $snippet;
    }

    public function getSnippet () {
        return $this->snippet;
    }

}

?>
