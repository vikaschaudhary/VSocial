<?php
namespace VSocial\Google\Auth;

use VSocial\Google\Auth\PemVerifier;
use VSocial\Google\Auth\LoginTicket;
use VSocial\Google\Service\Utils;
use VSocial\Google\Auth\Auth;
use VSocial\Google\IO\HttpRequest;
use VSocial\Google\Auth\AuthException;
use VSocial\Google\Auth\AssertionCredentials;
use VSocial\Google\Client;

class OAuth2
        extends Auth {

    public $clientId;
    public $clientSecret;
    public $developerKey;
    public $token;
    public $redirectUri;
    public $state;
    public $accessType = 'offline';
    public $approvalPrompt = 'force';
    public $requestVisibleActions;

    /** @var AssertionCredentials $assertionCredentials */
    public $assertionCredentials;

    const OAUTH2_REVOKE_URI = 'https://accounts.google.com/o/oauth2/revoke';
    const OAUTH2_TOKEN_URI = 'https://accounts.google.com/o/oauth2/token';
    const OAUTH2_AUTH_URL = 'https://accounts.google.com/o/oauth2/auth';
    const OAUTH2_FEDERATED_SIGNON_CERTS_URL = 'https://www.googleapis.com/oauth2/v1/certs';
    const CLOCK_SKEW_SECS = 300; // five minutes in seconds
    const AUTH_TOKEN_LIFETIME_SECS = 300; // five minutes in seconds
    const MAX_TOKEN_LIFETIME_SECS = 86400; // one day in seconds

    /**
     * Instantiates the class, but does not initiate the login flow, leaving it
     * to the discretion of the caller (which is done by calling authenticate()).
     */

    public function __construct () {

        $apiConfig = \VSocial\Utils\Storage::get("config");

        if (!empty($apiConfig['developer_key'])) {
            $this->developerKey = $apiConfig['developer_key'];
        }

        if (!empty($apiConfig['oauth2_client_id'])) {
            $this->clientId = $apiConfig['oauth2_client_id'];
        }

        if (!empty($apiConfig['oauth2_client_secret'])) {
            $this->clientSecret = $apiConfig['oauth2_client_secret'];
        }

        if (!empty($apiConfig['oauth2_redirect_uri'])) {
            $this->redirectUri = $apiConfig['oauth2_redirect_uri'];
        }

        if (!empty($apiConfig['oauth2_access_type'])) {
            $this->accessType = $apiConfig['oauth2_access_type'];
        }

        if (!empty($apiConfig['oauth2_approval_prompt'])) {
            $this->approvalPrompt = $apiConfig['oauth2_approval_prompt'];
        }
    }

    /**
     * @param $service
     * @param string|null $code
     * @throws AuthException
     * @return string
     */
    public function authenticate ($service, $code = null) {
        if (!$code && isset($_GET['code'])) {
            $code = $_GET['code'];
        }

        if ($code) {
            // We got here from the redirect from a successful authorization grant, fetch the access token
            $request = Client::$io->makeRequest(new HttpRequest(self::OAUTH2_TOKEN_URI, 'POST', array(), array(
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectUri,
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            )));

            if ($request->getResponseHttpCode() == 200) {
                $this->setAccessToken($request->getResponseBody());
                $this->token['created'] = time();
                return $this->getAccessToken();
            } else {
                $response = $request->getResponseBody();
                $decodedResponse = json_decode($response, true);
                if ($decodedResponse != null && $decodedResponse['error']) {
                    $response = $decodedResponse['error'];
                }
                throw new AuthException("Error fetching OAuth2 access token, message: '$response'", $request->getResponseHttpCode());
            }
        }

        $authUrl = $this->createAuthUrl($service['scope']);
        header('Location: ' . $authUrl);
        return true;
    }

    /**
     * Create a URL to obtain user authorization.
     * The authorization endpoint allows the user to first
     * authenticate, and then grant/deny the access request.
     * @param string $scope The scope is expressed as a list of space-delimited strings.
     * @return string
     */
    public function createAuthUrl ($scope) {
        $params = array(
            'response_type=code',
            'redirect_uri=' . urlencode($this->redirectUri),
            'client_id=' . urlencode($this->clientId),
            'scope=' . urlencode($scope),
            'access_type=' . urlencode($this->accessType),
            'approval_prompt=' . urlencode($this->approvalPrompt),
        );

        // if the list of scopes contains plus.login, add request_visible_actions
        // to auth URL
        if (strpos($scope, 'plus.login') && count($this->requestVisibleActions) > 0) {
            $params[] = 'request_visible_actions=' .
                    urlencode($this->requestVisibleActions);
        }

        if (isset($this->state)) {
            $params[] = 'state=' . urlencode($this->state);
        }
        $params = implode('&', $params);
        return self::OAUTH2_AUTH_URL . "?$params";
    }

    /**
     * @param string $token
     * @throws AuthException
     */
    public function setAccessToken ($token) {
        $token = json_decode($token, true);
        if ($token == null) {
            throw new AuthException('Could not json decode the token');
        }
        if (!isset($token['access_token'])) {
            throw new AuthException("Invalid token format");
        }
        $this->token = $token;
    }

    public function getAccessToken () {
        return json_encode($this->token);
    }

    public function setDeveloperKey ($developerKey) {
        $this->developerKey = $developerKey;
    }

    public function setState ($state) {
        $this->state = $state;
    }

    public function setAccessType ($accessType) {
        $this->accessType = $accessType;
    }

    public function setApprovalPrompt ($approvalPrompt) {
        $this->approvalPrompt = $approvalPrompt;
    }

    public function setAssertionCredentials (AssertionCredentials $creds) {
        $this->assertionCredentials = $creds;
    }

    /**
     * Include an accessToken in a given apiHttpRequest.
     * @param HttpRequest $request
     * @return HttpRequest
     * @throws AuthException
     */
    public function sign (HttpRequest $request) {
        // add the developer key to the request before signing it
        if ($this->developerKey) {
            $requestUrl = $request->getUrl();
            $requestUrl .= (strpos($request->getUrl(), '?') === false) ? '?' : '&';
            $requestUrl .= 'key=' . urlencode($this->developerKey);
            $request->setUrl($requestUrl);
        }

        // Cannot sign the request without an OAuth access token.
        if (null == $this->token && null == $this->assertionCredentials) {
            return $request;
        }

        // Check if the token is set to expire in the next 30 seconds
        // (or has already expired).
        if ($this->isAccessTokenExpired()) {
            if ($this->assertionCredentials) {
                $this->refreshTokenWithAssertion();
            } else {
                if (!array_key_exists('refresh_token', $this->token)) {
                    throw new AuthException("The OAuth 2.0 access token has expired, "
                    . "and a refresh token is not available. Refresh tokens are not "
                    . "returned for responses that were auto-approved.");
                }
                $this->refreshToken($this->token['refresh_token']);
            }
        }

        // Add the OAuth2 header to the request
        $request->setRequestHeaders(
                array('Authorization' => 'Bearer ' . $this->token['access_token'])
        );

        return $request;
    }

    /**
     * Fetches a fresh access token with the given refresh token.
     * @param string $refreshToken
     * @return void
     */
    public function refreshToken ($refreshToken) {
        $this->refreshTokenRequest(array(
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token'
        ));
    }

    /**
     * Fetches a fresh access token with a given assertion token.
     * @param AssertionCredentials $assertionCredentials optional.
     * @return void
     */
    public function refreshTokenWithAssertion ($assertionCredentials = null) {
        if (!$assertionCredentials) {
            $assertionCredentials = $this->assertionCredentials;
        }

        $this->refreshTokenRequest(array(
            'grant_type' => 'assertion',
            'assertion_type' => $assertionCredentials->assertionType,
            'assertion' => $assertionCredentials->generateAssertion(),
        ));
    }

    private function refreshTokenRequest ($params) {
        $http = new HttpRequest(self::OAUTH2_TOKEN_URI, 'POST', array(), $params);
        $request = Client::$io->makeRequest($http);

        $code = $request->getResponseHttpCode();
        $body = $request->getResponseBody();
        if (200 == $code) {
            $token = json_decode($body, true);
            if ($token == null) {
                throw new AuthException("Could not json decode the access token");
            }

            if (!isset($token['access_token']) || !isset($token['expires_in'])) {
                throw new AuthException("Invalid token format");
            }

            $this->token['access_token'] = $token['access_token'];
            $this->token['expires_in'] = $token['expires_in'];
            $this->token['created'] = time();
        } else {
            throw new AuthException("Error refreshing the OAuth2 token, message: '$body'", $code);
        }
    }

    /**
     * Revoke an OAuth2 access token or refresh token. This method will revoke the current access
     * token, if a token isn't provided.
     * @throws AuthException
     * @param string|null $token The token (access token or a refresh token) that should be revoked.
     * @return boolean Returns True if the revocation was successful, otherwise False.
     */
    public function revokeToken ($token = null) {
        if (!$token) {
            $token = $this->token['access_token'];
        }
        $request = new HttpRequest(self::OAUTH2_REVOKE_URI, 'POST', array(), "token=$token");
        $response = Client::$io->makeRequest($request);
        $code = $response->getResponseHttpCode();
        if ($code == 200) {
            $this->token = null;
            return true;
        }

        return false;
    }

    /**
     * Returns if the access_token is expired.
     * @return bool Returns True if the access_token is expired.
     */
    public function isAccessTokenExpired () {
        if (null == $this->token) {
            return true;
        }

        // If the token is set to expire in the next 30 seconds.
        $expired = ($this->token['created'] + ($this->token['expires_in'] - 30)) < time();

        return $expired;
    }

    // Gets federated sign-on certificates to use for verifying identity tokens.
    // Returns certs as array structure, where keys are key ids, and values
    // are PEM encoded certificates.
    private function getFederatedSignOnCerts () {
        // This relies on makeRequest caching certificate responses.
        $request = Client::$io->makeRequest(new HttpRequest(
                self::OAUTH2_FEDERATED_SIGNON_CERTS_URL));
        if ($request->getResponseHttpCode() == 200) {
            $certs = json_decode($request->getResponseBody(), true);
            if ($certs) {
                return $certs;
            }
        }
        throw new AuthException(
        "Failed to retrieve verification certificates: '" .
        $request->getResponseBody() . "'.", $request->getResponseHttpCode());
    }

    /**
     * Verifies an id token and returns the authenticated apiLoginTicket.
     * Throws an exception if the id token is not valid.
     * The audience parameter can be used to control which id tokens are
     * accepted.  By default, the id token must have been issued to this OAuth2 client.
     *
     * @param $id_token
     * @param $audience
     * @return LoginTicket
     */
    public function verifyIdToken ($id_token = null, $audience = null) {
        if (!$id_token) {
            $id_token = $this->token['id_token'];
        }

        $certs = $this->getFederatedSignonCerts();
        if (!$audience) {
            $audience = $this->clientId;
        }
        return $this->verifySignedJwtWithCerts($id_token, $certs, $audience);
    }

    // Verifies the id token, returns the verified token contents.
    // Visible for testing.
    function verifySignedJwtWithCerts ($jwt, $certs, $required_audience) {
        $segments = explode(".", $jwt);
        if (count($segments) != 3) {
            throw new AuthException("Wrong number of segments in token: $jwt");
        }
        $signed = $segments[0] . "." . $segments[1];
        $signature = Utils::urlSafeB64Decode($segments[2]);

        // Parse envelope.
        $envelope = json_decode(Utils::urlSafeB64Decode($segments[0]), true);
        if (!$envelope) {
            throw new AuthException("Can't parse token envelope: " . $segments[0]);
        }

        // Parse token
        $json_body = Utils::urlSafeB64Decode($segments[1]);
        $payload = json_decode($json_body, true);
        if (!$payload) {
            throw new AuthException("Can't parse token payload: " . $segments[1]);
        }

        // Check signature
        $verified = false;
        foreach ($certs as $keyName => $pem) {
            $public_key = new PemVerifier($pem);
            if ($public_key->verify($signed, $signature)) {
                $verified = true;
                break;
            }
        }

        if (!$verified) {
            throw new AuthException("Invalid token signature: $jwt");
        }

        // Check issued-at timestamp
        $iat = 0;
        if (array_key_exists("iat", $payload)) {
            $iat = $payload["iat"];
        }
        if (!$iat) {
            throw new AuthException("No issue time in token: $json_body");
        }
        $earliest = $iat - self::CLOCK_SKEW_SECS;

        // Check expiration timestamp
        $now = time();
        $exp = 0;
        if (array_key_exists("exp", $payload)) {
            $exp = $payload["exp"];
        }
        if (!$exp) {
            throw new AuthException("No expiration time in token: $json_body");
        }
        if ($exp >= $now + self::MAX_TOKEN_LIFETIME_SECS) {
            throw new AuthException(
            "Expiration time too far in future: $json_body");
        }

        $latest = $exp + self::CLOCK_SKEW_SECS;
        if ($now < $earliest) {
            throw new AuthException(
            "Token used too early, $now < $earliest: $json_body");
        }
        if ($now > $latest) {
            throw new AuthException(
            "Token used too late, $now > $latest: $json_body");
        }

        // TODO(beaton): check issuer field?
        // Check audience
        $aud = $payload["aud"];
        if ($aud != $required_audience) {
            throw new AuthException("Wrong recipient, $aud != $required_audience: $json_body");
        }

        // All good.
        return new LoginTicket($envelope, $payload);
    }

}
