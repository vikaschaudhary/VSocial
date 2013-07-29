<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class TopicDetails
        extends Model {

    public $topicIds;

    public function setTopicIds (/* array(Google_string) */ $topicIds) {
        $this->assertIsArray($topicIds, 'Google_string', __METHOD__);
        $this->topicIds = $topicIds;
    }

    public function getTopicIds () {
        return $this->topicIds;
    }

}

?>