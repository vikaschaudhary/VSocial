<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class AccessPolicy
        extends Model {

    public $allowed;
    public $exception;

    public function setAllowed ($allowed) {
        $this->allowed = $allowed;
    }

    public function getAllowed () {
        return $this->allowed;
    }

    public function setException (/* array(Google_string) */ $exception) {
        $this->assertIsArray($exception, 'Google_string', __METHOD__);
        $this->exception = $exception;
    }

    public function getException () {
        return $this->exception;
    }

}

?>
