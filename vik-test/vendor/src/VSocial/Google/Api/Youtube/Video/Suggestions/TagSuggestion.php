<?php
namespace VSocial\Google\Api\Youtube\Video\Suggestions;

use VSocial\Google\Service\Model;

class TagSuggestion
        extends Model {

    public $categoryRestricts;
    public $tag;

    public function setCategoryRestricts (/* array(Google_string) */ $categoryRestricts) {
        $this->assertIsArray($categoryRestricts, 'Google_string', __METHOD__);
        $this->categoryRestricts = $categoryRestricts;
    }

    public function getCategoryRestricts () {
        return $this->categoryRestricts;
    }

    public function setTag ($tag) {
        $this->tag = $tag;
    }

    public function getTag () {
        return $this->tag;
    }

}

?>