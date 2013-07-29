<?php
namespace VSocial\Google\Api;

use VSocial\Google\Client;
use VSocial\Google\Service\Service;
use VSocial\Google\Api\YouTubeAnalytics\ServiceResource as ReportsServiceResource;

class YouTubeAnalytics
        extends Service {

    public $reports;

    /**
     * Constructs the internal representation of the YouTubeAnalytics service.
     *
     * @param Google_Client $client
     */
    public function __construct (Client $client) {
        $this->servicePath = 'youtube/analytics/v1/';
        $this->version = 'v1';
        $this->serviceName = 'youtubeAnalytics';

        $client->addService($this->serviceName, $this->version);
        $this->reports = new ReportsServiceResource($this, $this->serviceName, 'reports', json_decode('{"methods": {"query": {"id": "youtubeAnalytics.reports.query", "path": "reports", "httpMethod": "GET", "parameters": {"dimensions": {"type": "string", "location": "query"}, "end-date": {"type": "string", "required": true, "location": "query"}, "filters": {"type": "string", "location": "query"}, "ids": {"type": "string", "required": true, "location": "query"}, "max-results": {"type": "integer", "format": "int32", "minimum": "1", "location": "query"}, "metrics": {"type": "string", "required": true, "location": "query"}, "sort": {"type": "string", "location": "query"}, "start-date": {"type": "string", "required": true, "location": "query"}, "start-index": {"type": "integer", "format": "int32", "minimum": "1", "location": "query"}}, "response": {"$ref": "ResultTable"}, "scopes": ["https://www.googleapis.com/auth/yt-analytics-monetary.readonly", "https://www.googleapis.com/auth/yt-analytics.readonly"]}}}', true));
    }

}

?>
