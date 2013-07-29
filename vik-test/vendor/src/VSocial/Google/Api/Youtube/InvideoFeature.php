<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class InvideoFeature
        extends Model {

    protected $__featuredChannelType = '\\VSocial\\Google\\Api\Youtube\\FeaturedChannel';
    protected $__featuredChannelDataType = '';
    public $featuredChannel;
    protected $__featuredVideoType = '\\VSocial\\Google\\Api\Youtube\\FeaturedVideo';
    protected $__featuredVideoDataType = '';
    public $featuredVideo;

    public function setFeaturedChannel (FeaturedChannel $featuredChannel) {
        $this->featuredChannel = $featuredChannel;
    }

    public function getFeaturedChannel () {
        return $this->featuredChannel;
    }

    public function setFeaturedVideo (FeaturedVideo $featuredVideo) {
        $this->featuredVideo = $featuredVideo;
    }

    public function getFeaturedVideo () {
        return $this->featuredVideo;
    }

}

?>
