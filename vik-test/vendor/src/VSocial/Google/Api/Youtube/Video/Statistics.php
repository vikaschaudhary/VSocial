<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class Statistics
        extends Model {

    public $commentCount;
    public $dislikeCount;
    public $favoriteCount;
    public $likeCount;
    public $viewCount;

    public function setCommentCount ($commentCount) {
        $this->commentCount = $commentCount;
    }

    public function getCommentCount () {
        return $this->commentCount;
    }

    public function setDislikeCount ($dislikeCount) {
        $this->dislikeCount = $dislikeCount;
    }

    public function getDislikeCount () {
        return $this->dislikeCount;
    }

    public function setFavoriteCount ($favoriteCount) {
        $this->favoriteCount = $favoriteCount;
    }

    public function getFavoriteCount () {
        return $this->favoriteCount;
    }

    public function setLikeCount ($likeCount) {
        $this->likeCount = $likeCount;
    }

    public function getLikeCount () {
        return $this->likeCount;
    }

    public function setViewCount ($viewCount) {
        $this->viewCount = $viewCount;
    }

    public function getViewCount () {
        return $this->viewCount;
    }

}

?>