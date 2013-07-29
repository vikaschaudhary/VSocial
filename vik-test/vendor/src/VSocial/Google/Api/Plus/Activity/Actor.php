<?php
namespace VSocial\Google\Api\Plus\Activity;

use VSocial\Google\Service\Model;

class Actor
        extends Model {

    public $displayName;
    public $id;
    protected $__imageType = '\\VSocial\\Google\\Api\\Plus\\Activity\\ActorImage';
    protected $__imageDataType = '';
    public $image;
    protected $__nameType = '\\VSocial\\Google\\Api\\Plus\\Activity\\ActorName';
    protected $__nameDataType = '';
    public $name;
    public $url;

    public function setDisplayName ($displayName) {
        $this->displayName = $displayName;
    }

    public function getDisplayName () {
        return $this->displayName;
    }

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setImage (ActorImage $image) {
        $this->image = $image;
    }

    public function getImage () {
        return $this->image;
    }

    public function setName (ActorName $name) {
        $this->name = $name;
    }

    public function getName () {
        return $this->name;
    }

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
