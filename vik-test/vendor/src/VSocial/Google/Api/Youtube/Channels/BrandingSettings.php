<?php
namespace VSocial\Google\Api\Youtube\Channels;

use VSocial\Google\Service\Model;

class BrandingSettings
        extends Model {

    protected $__channelType = 'Google_ChannelSettings';
    protected $__channelDataType = '';
    public $channel;
    protected $__hintsType = 'Google_PropertyValue';
    protected $__hintsDataType = 'array';
    public $hints;
    protected $__imageType = 'Google_ImageSettings';
    protected $__imageDataType = '';
    public $image;
    protected $__watchType = 'Google_WatchSettings';
    protected $__watchDataType = '';
    public $watch;

    public function setChannel (Google_ChannelSettings $channel) {
        $this->channel = $channel;
    }

    public function getChannel () {
        return $this->channel;
    }

    public function setHints (/* array(Google_PropertyValue) */ $hints) {
        $this->assertIsArray($hints, 'Google_PropertyValue', __METHOD__);
        $this->hints = $hints;
    }

    public function getHints () {
        return $this->hints;
    }

    public function setImage (Google_ImageSettings $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setWatch (Google_WatchSettings $watch) {
        $this->watch = $watch;
    }

    public function getWatch () {
        return $this->watch;
    }

}

?>
