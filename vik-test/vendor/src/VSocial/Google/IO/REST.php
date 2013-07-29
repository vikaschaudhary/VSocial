<?php
namespace VSocial\Google\IO;

use VSocial\Google\IO\HttpRequest;
use VSocial\Google\Service\ServiceException;
use VSocial\Google\External\Uri\TemplateParser;
use VSocial\Google\Client;

class REST {

    /**
     * Executes a apiServiceRequest using a RESTful call by transforming it into
     * an apiHttpRequest, and executed via apiIO::authenticatedRequest().
     *
     * @param HttpRequest $req
     * @return array decoded result
     * @throws ServiceException on server side error (ie: not authenticated,
     *  invalid or malformed post body, invalid url)
     */
    static public function execute (HttpRequest $req) {
        $httpRequest = Client::$io->makeRequest($req);
        $decodedResponse = self::decodeHttpResponse($httpRequest);
        $ret = isset($decodedResponse['data']) ? $decodedResponse['data'] : $decodedResponse;
        return $ret;
    }

    /**
     * Decode an HTTP Response.
     * @static
     * @throws ServiceException
     * @param HttpRequest $response The http response to be decoded.
     * @return mixed|null
     */
    public static function decodeHttpResponse ($response) {
        $code = $response->getResponseHttpCode();
        $body = $response->getResponseBody();
        $decoded = null;

        if ((intVal($code)) >= 300) {
            $decoded = json_decode($body, true);
            $err = 'Error calling ' . $response->getRequestMethod() . ' ' . $response->getUrl();
            if ($decoded != null && isset($decoded['error']['message']) && isset($decoded['error']['code'])) {
                // if we're getting a json encoded error definition, use that instead of the raw response
                // body for improved readability
                $err .= ": ({$decoded['error']['code']}) {$decoded['error']['message']}";
            } else {
                $err .= ": ($code) $body";
            }

            throw new ServiceException($err, $code, null, $decoded['error']['errors']);
        }

        // Only attempt to decode the response, if the response code wasn't (204) 'no content'
        if ($code != '204') {
            $decoded = json_decode($body, true);
            if ($decoded === null || $decoded === "") {
                throw new ServiceException("Invalid json in service response: $body");
            }
        }
        return $decoded;
    }

    /**
     * Parse/expand request parameters and create a fully qualified
     * request uri.
     * @static
     * @param string $servicePath
     * @param string $restPath
     * @param array $params
     * @return string $requestUrl
     */
    static function createRequestUri ($servicePath, $restPath, $params) {
        $requestUrl = $servicePath . $restPath;
        $uriTemplateVars = array();
        $queryVars = array();
        foreach ($params as $paramName => $paramSpec) {
            // Discovery v1.0 puts the canonical location under the 'location' field.
            if (!isset($paramSpec['location'])) {
                $paramSpec['location'] = $paramSpec['restParameterType'];
            }

            if ($paramSpec['type'] == 'boolean') {
                $paramSpec['value'] = ($paramSpec['value']) ? 'true' : 'false';
            }
            if ($paramSpec['location'] == 'path') {
                $uriTemplateVars[$paramName] = $paramSpec['value'];
            } else {
                if (isset($paramSpec['repeated']) && is_array($paramSpec['value'])) {
                    foreach ($paramSpec['value'] as $value) {
                        $queryVars[] = $paramName . '=' . rawurlencode($value);
                    }
                } else {
                    $queryVars[] = $paramName . '=' . rawurlencode($paramSpec['value']);
                }
            }
        }

        if (count($uriTemplateVars)) {
            $uriTemplateParser = new TemplateParser($requestUrl);
            $requestUrl = $uriTemplateParser->expand($uriTemplateVars);
        }
        //FIXME work around for the the uri template lib which url encodes
        // the @'s & confuses our servers.
        $requestUrl = str_replace('%40', '@', $requestUrl);

        if (count($queryVars)) {
            $requestUrl .= '?' . implode($queryVars, '&');
        }

        return $requestUrl;
    }

}
