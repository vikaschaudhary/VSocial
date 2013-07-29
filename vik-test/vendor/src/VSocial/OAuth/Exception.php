<?php

namespace VSocial\OAuth;

use Exception as Root_Exception;

class Exception
        extends Root_Exception {

    public function __construct ($message = null, $code = null, $previous = null) {
        parent::__construct($message, $code, $previous);
    }

}

?>
