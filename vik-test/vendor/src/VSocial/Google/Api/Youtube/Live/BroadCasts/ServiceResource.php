<?php
namespace VSocial\Google\Api\Youtube\Live\BroadCasts;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Binds a YouTube broadcast to a stream or removes an existing binding between a broadcast and a
     * stream. A broadcast can only be bound to one video stream. (liveBroadcasts.bind)
     *
     * @param string $id The id parameter specifies the unique ID of the broadcast that is being bound to a video stream.
     * @param string $part The part parameter specifies a comma-separated list of one or more liveBroadcast resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, and status.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string streamId The streamId parameter specifies the unique ID of the video stream that is being bound to a broadcast. If this parameter is omitted, the API will remove any existing binding between the broadcast and a video stream.
     * @return Google_LiveBroadcast
     */
    public function bind ($id, $part, $optParams = array()) {
        $params = array('id' => $id, 'part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('bind', array($params));
        if ($this->useObjects()) {
            return new Google_LiveBroadcast($data);
        } else {
            return $data;
        }
    }

    /**
     * Deletes a broadcast. (liveBroadcasts.delete)
     *
     * @param string $id The id parameter specifies the YouTube live broadcast ID for the resource that is being deleted.
     * @param array $optParams Optional parameters.
     */
    public function delete ($id, $optParams = array()) {
        $params = array('id' => $id);
        $params = array_merge($params, $optParams);
        $data = $this->__call('delete', array($params));
        return $data;
    }

    /**
     * Creates a broadcast. (liveBroadcasts.insert)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part properties that you can include in the parameter value are id, snippet, contentDetails, and status.
     * @param Google_LiveBroadcast $postBody
     * @param array $optParams Optional parameters.
     * @return Google_LiveBroadcast
     */
    public function insert ($part, Google_LiveBroadcast $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('insert', array($params));
        if ($this->useObjects()) {
            return new Google_LiveBroadcast($data);
        } else {
            return $data;
        }
    }

    /**
     * Returns a list of YouTube broadcasts that match the API request parameters. (liveBroadcasts.list)
     *
     * @param string $part The part parameter specifies a comma-separated list of one or more liveBroadcast resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, and status.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string broadcastStatus The broadcastStatus parameter filters the API response to only include broadcasts with the specified status.
     * @opt_param string id The id parameter specifies a comma-separated list of YouTube broadcast IDs that identify the broadcasts being retrieved. In a liveBroadcast resource, the id property specifies the broadcast's ID.
     * @opt_param string maxResults The maxResults parameter specifies the maximum number of items that should be returned in the result set. Acceptable values are 0 to 50, inclusive. The default value is 5.
     * @opt_param bool mine The mine parameter can be used to instruct the API to only return broadcasts owned by the authenticated user. Set the parameter value to true to only retrieve your own broadcasts.
     * @opt_param string pageToken The pageToken parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.
     * @return Google_LiveBroadcastList
     */
    public function listLiveBroadcasts ($part, $optParams = array()) {
        $params = array('part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Google_LiveBroadcastList($data);
        } else {
            return $data;
        }
    }

    /**
     * Changes the status of a YouTube live broadcast and initiates any processes associated with the
     * new status. For example, when you transition a broadcast's status to testing, YouTube starts to
     * transmit video to that broadcast's monitor stream. (liveBroadcasts.transition)
     *
     * @param string $broadcastStatus The broadcastStatus parameter identifies the state to which the broadcast is changing.
     * @param string $id The id parameter specifies the unique ID of the broadcast that is transitioning to another status.
     * @param string $part The part parameter specifies a comma-separated list of one or more liveBroadcast resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, and status.
     * @param array $optParams Optional parameters.
     * @return Google_LiveBroadcast
     */
    public function transition ($broadcastStatus, $id, $part, $optParams = array()) {
        $params = array('broadcastStatus' => $broadcastStatus, 'id' => $id, 'part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('transition', array($params));
        if ($this->useObjects()) {
            return new Google_LiveBroadcast($data);
        } else {
            return $data;
        }
    }

    /**
     * Updates a broadcast. For example, you could modify the broadcast settings defined in the
     * liveBroadcast resource's contentDetails object. (liveBroadcasts.update)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part properties that you can include in the parameter value are id, snippet, contentDetails, and status.
      Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. For example, a broadcast's privacy status is defined in the status part. As such, if your request is updating a private or unlisted broadcast, and the request's part parameter value includes the status part, the broadcast's privacy setting will be updated to whatever value the request body specifies. If the request body does not specify a value, the existing privacy setting will be removed and the broadcast will revert to the default privacy setting.
     * @param Google_LiveBroadcast $postBody
     * @param array $optParams Optional parameters.
     * @return Google_LiveBroadcast
     */
    public function update ($part, Google_LiveBroadcast $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('update', array($params));
        if ($this->useObjects()) {
            return new Google_LiveBroadcast($data);
        } else {
            return $data;
        }
    }

}

?>
