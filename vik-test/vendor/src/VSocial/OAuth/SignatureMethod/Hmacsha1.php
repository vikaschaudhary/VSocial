<?php
namespace VSocial\OAuth\SignatureMethod;

use VSocial\OAuth\SignatureMethod\SignatureMethod as OAuthSignatureMethod;
use VSocial\OAuth\Util as OAuthUtil;
use VSocial\OAuth\Consumer as OAuthConsumer;
use VSocial\OAuth\Request as OAuthRequest;
use VSocial\OAuth\Token as OAuthToken;

class Hmacsha1
        extends OAuthSignatureMethod {

    function get_name () {
        return "HMAC-SHA1";
    }

    public function build_signature (OAuthRequest $request, OAuthConsumer $consumer, $token) {
        $base_string = $request->get_signature_base_string();
        $request->base_string = $base_string;

        $keyparts = array(
            $consumer->secret,
            ($token) ? $token->secret : ""
        );

        $key_parts = OAuthUtil::urlencode_rfc3986($keyparts);
        $key = implode('&', $key_parts);

        return base64_encode(hash_hmac('sha1', $base_string, $key, true));
    }

}

?>
