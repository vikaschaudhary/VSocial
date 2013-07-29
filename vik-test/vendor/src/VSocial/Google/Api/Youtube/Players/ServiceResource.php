<?php
namespace VSocial\Google\Api\Youtube\Players;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Returns the data required to play the videos specified on the request, or restriction information
     * explaining why it can't be played. (players.list)
     *
     * @param string $part The part parameter specifies a comma-separated list of one or more player resource properties that the API response will include.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string itag If specified, the itag parameter specifies a comma-separated list of itags video formats the client is interested in. The returned formats will be a subset of those itags.
     * @opt_param string videoId The videoId parameter specifies a comma-separated list of the YouTube video ID(s) for the resource(s) that are being retrieved.
     * @return Google_PlayerListResponse
     */
    public function listPlayers ($part, $optParams = array()) {
        $params = array('part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Google_PlayerListResponse($data);
        } else {
            return $data;
        }
    }

}

?>
