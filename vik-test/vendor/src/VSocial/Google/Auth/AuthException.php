<?php
namespace VSocial\Google\Auth;

use Exception;

class AuthException
        extends Exception {

    public function __construct ($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

?>
