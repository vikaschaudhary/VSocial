<?php
namespace VSocial\Google\IO;

use VSocial\Google\IO\HttpRequest;

interface IO {

    /**
     * An utility function that first calls $this->auth->sign($request) and then executes makeRequest()
     * on that signed request. Used for when a request should be authenticated
     * @param HttpRequest $request
     * @return HttpRequest $request
     */
    public function authenticatedRequest (HttpRequest $request);

    /**
     * Executes a apIHttpRequest and returns the resulting populated httpRequest
     * @param HttpRequest $request
     * @return HttpRequest $request
     */
    public function makeRequest (HttpRequest $request);

    /**
     * Set options that update the transport implementation's behavior.
     * @param $options
     */
    public function setOptions ($options);
}
