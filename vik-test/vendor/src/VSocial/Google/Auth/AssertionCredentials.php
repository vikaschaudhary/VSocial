<?php
namespace VSocial\Google\Auth;

use VSocial\Google\Auth\OAuth2;
use VSocial\Google\Service\Utils;
use VSocial\Google\Auth\P12Signer;

class AssertionCredentials {

    const MAX_TOKEN_LIFETIME_SECS = 3600;

    public $serviceAccountName;
    public $scopes;
    public $privateKey;
    public $privateKeyPassword;
    public $assertionType;
    public $sub;
    public $prn;

    public function __construct ($serviceAccountName, $scopes, $privateKey, $privateKeyPassword = 'notasecret', $assertionType = 'http://oauth.net/grant_type/jwt/1.0/bearer', $sub = false) {
        $this->serviceAccountName = $serviceAccountName;
        $this->scopes = is_string($scopes) ? $scopes : implode(' ', $scopes);
        $this->privateKey = $privateKey;
        $this->privateKeyPassword = $privateKeyPassword;
        $this->assertionType = $assertionType;
        $this->sub = $sub;
        $this->prn = $sub;
    }

    public function generateAssertion () {
        $now = time();

        $jwtParams = array(
            'aud' => OAuth2::OAUTH2_TOKEN_URI,
            'scope' => $this->scopes,
            'iat' => $now,
            'exp' => $now + self::MAX_TOKEN_LIFETIME_SECS,
            'iss' => $this->serviceAccountName,
        );

        if ($this->sub !== false) {
            $jwtParams['sub'] = $this->sub;
        } else if ($this->prn !== false) {
            $jwtParams['prn'] = $this->prn;
        }

        return $this->makeSignedJwt($jwtParams);
    }

    private function makeSignedJwt ($payload) {
        $header = array('typ' => 'JWT', 'alg' => 'RS256');

        $segments = array(
            Utils::urlSafeB64Encode(json_encode($header)),
            Utils::urlSafeB64Encode(json_encode($payload))
        );

        $signingInput = implode('.', $segments);
        $signer = new P12Signer($this->privateKey, $this->privateKeyPassword);
        $signature = $signer->sign($signingInput);
        $segments[] = Utils::urlSafeB64Encode($signature);

        return implode(".", $segments);
    }

}
