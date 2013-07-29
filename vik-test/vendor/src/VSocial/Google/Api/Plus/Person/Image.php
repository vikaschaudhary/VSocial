<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;
class Image
        extends Model {

    public $url;

    public function setUrl ($url) {
        $this->url = $url;
    }

    public function getUrl () {
        return $this->url;
    }

}

?>
