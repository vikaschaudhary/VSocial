<?php
namespace VSocial\Google\Api\Youtube\Activity\Content;

use VSocial\Google\Service\Model;

class Details
        extends Model {

    protected $__bulletinType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Bulletin';
    protected $__bulletinDataType = '';
    public $bulletin;
    protected $__channelItemType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\ChannelItem';
    protected $__channelItemDataType = '';
    public $channelItem;
    protected $__commentType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Comment';
    protected $__commentDataType = '';
    public $comment;
    protected $__favoriteType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Favorite';
    protected $__favoriteDataType = '';
    public $favorite;
    protected $__likeType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Like';
    protected $__likeDataType = '';
    public $like;
    protected $__playlistItemType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\PlaylistItem';
    protected $__playlistItemDataType = '';
    public $playlistItem;
    protected $__recommendationType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Recommendation';
    protected $__recommendationDataType = '';
    public $recommendation;
    protected $__socialType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Social';
    protected $__socialDataType = '';
    public $social;
    protected $__subscriptionType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Subscription';
    protected $__subscriptionDataType = '';
    public $subscription;
    protected $__uploadType = '\\VSocial\\Google\\Api\\Youtube\\Activity\\Content\\Details\\Upload';
    protected $__uploadDataType = '';
    public $upload;

    public function setBulletin (Details\Bulletin $bulletin) {
        $this->bulletin = $bulletin;
    }

    public function getBulletin () {
        return $this->bulletin;
    }

    public function setChannelItem (Details\ChannelItem $channelItem) {
        $this->channelItem = $channelItem;
    }

    public function getChannelItem () {
        return $this->channelItem;
    }

    public function setComment (Details\Comment $comment) {
        $this->comment = $comment;
    }

    public function getComment () {
        return $this->comment;
    }

    public function setFavorite (Details\Favorite $favorite) {
        $this->favorite = $favorite;
    }

    public function getFavorite () {
        return $this->favorite;
    }

    public function setLike (Details\Like $like) {
        $this->like = $like;
    }

    public function getLike () {
        return $this->like;
    }

    public function setPlaylistItem (Details\PlaylistItem $playlistItem) {
        $this->playlistItem = $playlistItem;
    }

    public function getPlaylistItem () {
        return $this->playlistItem;
    }

    public function setRecommendation (Details\Recommendation $recommendation) {
        $this->recommendation = $recommendation;
    }

    public function getRecommendation () {
        return $this->recommendation;
    }

    public function setSocial (Details\Social $social) {
        $this->social = $social;
    }

    public function getSocial () {
        return $this->social;
    }

    public function setSubscription (Details\Subscription $subscription) {
        $this->subscription = $subscription;
    }

    public function getSubscription () {
        return $this->subscription;
    }

    public function setUpload (Details\Upload $upload) {
        $this->upload = $upload;
    }

    public function getUpload () {
        return $this->upload;
    }

}

?>
