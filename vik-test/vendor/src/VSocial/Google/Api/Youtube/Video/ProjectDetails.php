<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class ProjectDetails
        extends Model {

    public $tags;

    public function setTags (/* array(Google_string) */ $tags) {
        $this->assertIsArray($tags, 'Google_string', __METHOD__);
        $this->tags = $tags;
    }

    public function getTags () {
        return $this->tags;
    }

}

?>