<?php

namespace VSocial\OAuth\SignatureMethod;

use VSocial\OAuth\Consumer as OAuthConsumer;
use VSocial\OAuth\Request as OAuthRequest;
use VSocial\OAuth\Token as OAuthToken;

abstract class SignatureMethod {

    /**
     * Needs to return the name of the Signature Method (ie HMAC-SHA1)
     * @return string
     */
    abstract public function get_name ();

    /**
     * Build up the signature
     * NOTE: The output of this function MUST NOT be urlencoded.
     * the encoding is handled in OAuthRequest when the final
     * request is serialized
     * @param OAuthRequest $request
     * @param OAuthConsumer $consumer
     * @param OAuthToken $token
     * @return string
     */
    abstract public function build_signature (OAuthRequest $request, OAuthConsumer $consumer, $token);

    /**
     * Verifies that a given signature is correct
     * @param OAuthRequest $request
     * @param OAuthConsumer $consumer
     * @param OAuthToken $token
     * @param string $signature
     * @return bool
     */
    public function check_signature (OAuthRequest $request, OAuthConsumer $consumer, $token, $signature) {
        $built = $this->build_signature($request, $consumer, $token);
        return $built == $signature;
    }

}

?>
