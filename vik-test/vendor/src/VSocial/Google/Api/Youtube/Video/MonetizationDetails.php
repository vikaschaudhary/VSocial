<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;
class MonetizationDetails
        extends Model {

    protected $__accessType = 'Google_AccessPolicy';
    protected $__accessDataType = '';
    public $access;

    public function setAccess (Google_AccessPolicy $access) {
        $this->access = $access;
    }

    public function getAccess () {
        return $this->access;
    }

}

?>