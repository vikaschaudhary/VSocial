<?php

namespace VSocial\OAuth\SignatureMethod;

use VSocial\OAuth\SignatureMethod\SignatureMethod as OAuthSignatureMethod;
use VSocial\OAuth\Util as OAuthUtil;
use VSocial\OAuth\Consumer as OAuthConsumer;
use VSocial\OAuth\Request as OAuthRequest;
use VSocial\OAuth\Token as OAuthToken;

class PLAINTEXT
        extends OAuthSignatureMethod {

    public function get_name () {
        return "PLAINTEXT";
    }

    /**
     * oauth_signature is set to the concatenated encoded values of the Consumer Secret and 
     * Token Secret, separated by a '&' character (ASCII code 38), even if either secret is 
     * empty. The result MUST be encoded again.
     *   - Chapter 9.4.1 ("Generating Signatures")
     *
     * Please note that the second encoding MUST NOT happen in the SignatureMethod, as
     * OAuthRequest handles this!
     */
    public function build_signature (OAuthRequest $request, OAuthConsumer $consumer, OAuthToken $token) {
        $keyparts = array(
            $consumer->secret,
            ($token) ? $token->secret : ""
        );

        $key_parts = OAuthUtil::urlencode_rfc3986($keyparts);
        $key = implode('&', $key_parts);
        $request->base_string = $key;

        return $key;
    }

}

?>
