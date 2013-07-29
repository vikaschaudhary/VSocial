<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\Model;

class VideoUrls
        extends Model {

    protected $__restrictionType = 'Google_PlayerRestrictionDetails';
    protected $__restrictionDataType = '';
    public $restriction;
    protected $__urlType = 'Google_PlayerVideoUrl';
    protected $__urlDataType = 'array';
    public $url;

    public function setRestriction (Google_PlayerRestrictionDetails $restriction) {
        $this->restriction = $restriction;
    }

    public function getRestriction () {
        return $this->restriction;
    }

    public function setUrl (/* array(Google_PlayerVideoUrl) */ $url) {
        $this->assertIsArray($url, 'Google_PlayerVideoUrl', __METHOD__);
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
