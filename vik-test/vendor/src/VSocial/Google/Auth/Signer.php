<?php
namespace VSocial\Google\Auth;

/**
 * Signs data.
 *
 * @author Brian Eaton <beaton@google.com>
 */
abstract class Signer {

    /**
     * Signs data, returns the signature as binary data.
     */
    abstract public function sign ($data);
}
