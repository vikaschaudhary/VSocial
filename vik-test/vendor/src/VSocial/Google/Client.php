<?php
namespace VSocial\Google;

use VSocial\Google\GoogleException;
use VSocial\Google\Auth;
use VSocial\Google\Cache;
use VSocial\Google\IO;

class Client {

    /**
     * @static
     * @var Auth $auth
     */
    static $auth;

    /**
     * @static
     * @var IO $io
     */
    static $io;

    /**
     * @static
     * @var Cache $cache
     */
    static $cache;

    /**
     * @static
     * @var boolean $useBatch
     */
    static $useBatch = false;

    /** @var array $scopes */
    protected $scopes = array();

    /** @var bool $useObjects */
    protected $useObjects = false;

    /**
     * definitions of services that are discovered.
     * @var type 
     */
    protected $services = array();

    /**
     * Used to track authenticated state, can't discover services after doing authenticate()
     * @var type  
     */
    private $authenticated = false;
    protected $apiConfig = array();

    const APPLICATION_NAME = "VSocial Google PHP Application";

    public function __construct ($config = array()) {
        /**
         * Check for requirements
         */
        /**
         * check for curl to be enabled
         */
        if (!function_exists('curl_init')) {
            throw new GoogleException('Google PHP API Client requires the CURL PHP extension');
        }
        /**
         * Check for json extension
         */
        if (!function_exists('json_decode')) {
            throw new GoogleException('Google PHP API Client requires the JSON PHP extension');
        }

        /**
         * Check for http_build_query
         */
        if (!function_exists('http_build_query')) {
            throw new GoogleException('Google PHP API Client requires http_build_query()');
        }
        /**
         * Check for default timezone settings
         */
        if (!ini_get('date.timezone') && function_exists('date_default_timezone_set')) {
            date_default_timezone_set('UTC');
        }


        $this->apiConfig = array_merge($this->apiConfig, $config);
        /**
         * Set Cache
         */
        $cacheClass = strtolower($this->apiConfig['cacheClass']);
        switch ($cacheClass) {
            case "file":
                self::$cache = new Cache\File();
                break;
            default:
                self::$cache = new Cache\File();
                break;
        }
        /**
         * Set Auth
         */
        $authClass = strtolower($this->apiConfig['cacheClass']);
        switch ($authClass) {
            case "oauth2":
                self::$auth = new Auth\OAuth2();
                break;
            default:
                self::$auth = new Auth\OAuth2();
                break;
        }
        /**
         * Set IO Class
         */
        $ioClass = strtolower($this->apiConfig['cacheClass']);
        switch ($ioClass) {
            case "curlio":
                self::$io = new IO\CurlIO();
                break;
            default:
                self::$io = new IO\CurlIO();
                break;
        }

        /**
         * Set Application 
         */
        $applicationName = isset($config['application_name']) ? $config['application_name'] : self::APPLICATION_NAME;
        $this->setApplicationName($applicationName);
        /**
         * Set Client ID
         */
        $clientId = $config['oauth2_client_id'];
        $this->setClientId($clientId);
        /**
         * Set Client Secret
         */
        $clientSecret = $config['oauth2_client_secret'];
        $this->setClientSecret($clientSecret);
        /**
         * Set Redirect URL
         */
        $redirectUri = $config['oauth2_redirect_uri'];
        $this->setRedirectUri($redirectUri);

        #\VSocial\Utils\Storage::set("config", $this->apiConfig);
    }

    public function addService ($service, $version = false) {

        if ($this->authenticated) {
            throw new GoogleException('Cant add services after having authenticated');
        }

        $this->services[$service] = array();
        if (isset($this->apiConfig['services'][$service])) {
            // Merge the service descriptor with the default values
            $this->services[$service] = array_merge($this->services[$service], $this->apiConfig['services'][$service]);
        }
    }

    public function authenticate ($code = null) {
        $service = $this->prepareService();
        $this->authenticated = true;
        return self::$auth->authenticate($service, $code);
    }

    public function prepareService () {
        $service = array();
        $scopes = array();
        if ($this->scopes) {
            $scopes = $this->scopes;
        } else {
            if (empty($this->services)) {
                $this->services = $this->apiConfig['services'];
            }            
            foreach ($this->services as $key => $val) {
                if (isset($val['scope'])) {
                    if (is_array($val['scope'])) {
                        $scopes = array_merge($val['scope'], $scopes);
                    } else {
                        $scopes[] = $val['scope'];
                    }
                } else {
                    $scopes[] = 'https://www.googleapis.com/auth/' . $key;
                }
                unset($val['discoveryURI']);
                unset($val['scope']);
                $service = array_merge($service, $val);
            }
        }
        $service['scope'] = implode(' ', $scopes);
        return $service;
    }

    public function setAccessToken ($accessToken) {
        if ($accessToken == null || 'null' == $accessToken) {
            $accessToken = null;
        }
        self::$auth->setAccessToken($accessToken);
    }

    public function setAuthClass ($authClassName) {
        self::$auth = new $authClassName();
    }

    public function createAuthUrl () {
        $service = $this->prepareService();
        return self::$auth->createAuthUrl($service['scope']);
    }

    public function getAccessToken () {
        $token = self::$auth->getAccessToken();
        return (null == $token || 'null' == $token) ? null : $token;
    }

    public function isAccessTokenExpired () {
        return self::$auth->isAccessTokenExpired();
    }

    public function setDeveloperKey ($developerKey) {
        self::$auth->setDeveloperKey($developerKey);
    }

    public function setState ($state) {
        self::$auth->setState($state);
    }

    public function setAccessType ($accessType) {
        self::$auth->setAccessType($accessType);
    }

    public function setApprovalPrompt ($approvalPrompt) {
        self::$auth->setApprovalPrompt($approvalPrompt);
    }

    public function setApplicationName ($applicationName) {

        $this->apiConfig['application_name'] = $applicationName;
    }

    public function setClientId ($clientId) {

        $this->apiConfig['oauth2_client_id'] = $clientId;
        self::$auth->clientId = $clientId;
    }

    public function getClientId () {
        return self::$auth->clientId;
    }

    public function setClientSecret ($clientSecret) {

        $this->apiConfig['oauth2_client_secret'] = $clientSecret;
        self::$auth->clientSecret = $clientSecret;
    }

    public function getClientSecret () {
        return self::$auth->clientSecret;
    }

    public function setRedirectUri ($redirectUri) {

        $this->apiConfig['oauth2_redirect_uri'] = $redirectUri;
        self::$auth->redirectUri = $redirectUri;
    }

    public function getRedirectUri () {
        return self::$auth->redirectUri;
    }

    public function refreshToken ($refreshToken) {
        self::$auth->refreshToken($refreshToken);
    }

    public function revokeToken ($token = null) {
        self::$auth->revokeToken($token);
    }

    public function verifyIdToken ($token = null) {
        return self::$auth->verifyIdToken($token);
    }

    public function setAssertionCredentials (Auth\AssertionCredentials $creds) {
        self::$auth->setAssertionCredentials($creds);
    }

    public function setScopes ($scopes) {
        $this->scopes = is_string($scopes) ? explode(" ", $scopes) : $scopes;
    }

    public function getScopes () {
        return $this->scopes;
    }

    public function setRequestVisibleActions ($requestVisibleActions) {
        self::$auth->requestVisibleActions =
                join(" ", $requestVisibleActions);
    }

    public function setUseObjects ($useObjects) {

        $this->apiConfig['use_objects'] = $useObjects;
    }

    public function setUseBatch ($useBatch) {
        self::$useBatch = $useBatch;
    }

    public static function getAuth () {
        return Client::$auth;
    }

    public static function getIo () {
        return Client::$io;
    }

    public function getCache () {
        return Client::$cache;
    }

}
