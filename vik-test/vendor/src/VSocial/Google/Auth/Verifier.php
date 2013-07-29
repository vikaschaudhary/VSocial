<?php
namespace VSocial\Google\Auth;

abstract class Verifier {

    /**
     * Checks a signature, returns true if the signature is correct,
     * false otherwise.
     */
    abstract public function verify ($data, $signature);
}
