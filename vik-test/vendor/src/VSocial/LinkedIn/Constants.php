<?php
namespace VSocial\LinkedIn;

class Constants {
    /**
     * api/oauth settings
     */

    const _API_OAUTH_REALM = 'http://api.linkedin.com';
    const _API_OAUTH_VERSION = '1.0';

    /**
     * the default response format from LinkedIn
     */
    const _DEFAULT_RESPONSE_FORMAT = 'xml';

    /**
     * Helper constants used to standardize LinkedIn <-> API communication.  
     * See demo page for usage.
     */
    const _GET_RESPONSE = 'lResponse';
    const _GET_TYPE = 'lType';

    /**
     * Invitation API constants.
     */
    const _INV_SUBJECT = 'Invitation to connect';
    const _INV_BODY_LENGTH = 200;

    /**
     *  API methods
     */
    const _METHOD_TOKENS = 'POST';

    /**
     *  Network API constants.
     */
    const _NETWORK_LENGTH = 1000;
    const _NETWORK_HTML = '<a>';

    /**
     * Response format type constants, see http://developer.linkedin.com/docs/DOC-1203
     */
    const _RESPONSE_JSON = 'JSON';
    const _RESPONSE_JSONP = 'JSONP';
    const _RESPONSE_XML = 'XML';

    /**
     *  Share API constants
     */
    const _SHARE_COMMENT_LENGTH = 700;
    const _SHARE_CONTENT_TITLE_LENGTH = 200;
    const _SHARE_CONTENT_DESC_LENGTH = 400;

    /**
     *  LinkedIn API end-points
     */
    const _URL_ACCESS = 'https://api.linkedin.com/uas/oauth/accessToken';
    const _URL_API = 'https://api.linkedin.com';
    const _URL_AUTH = 'https://www.linkedin.com/uas/oauth/authenticate?oauth_token=';
    const _URL_REQUEST = 'https://api.linkedin.com/uas/oauth/requestToken';
    const _URL_REVOKE = 'https://api.linkedin.com/uas/oauth/invalidateToken';

    /**
     *  Library version
     */
    const _VERSION = '3.2.0';

    /**
     * Port Config
     */
    const PORT_HTTP_SSL = 443;
    const PORT_HTTP = 80;

    /**
     * Dummy data
     */
    const DEMO_GROUP = 4010474;
    const DEMO_GROUP_NAME = 'Simple LinkedIn Demo';

}

?>
