<?php
namespace VSocial\Google\Api\Youtube\Live\Streams;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Deletes a video stream. (liveStreams.delete)
     *
     * @param string $id The id parameter specifies the YouTube live stream ID for the resource that is being deleted.
     * @param array $optParams Optional parameters.
     */
    public function delete ($id, $optParams = array()) {
        $params = array('id' => $id);
        $params = array_merge($params, $optParams);
        $data = $this->__call('delete', array($params));
        return $data;
    }

    /**
     * Creates a video stream. The stream enables you to send your video to YouTube, which can then
     * broadcast the video to your audience. (liveStreams.insert)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part properties that you can include in the parameter value are id, snippet, cdn, and status.
     * @param Google_LiveStream $postBody
     * @param array $optParams Optional parameters.
     * @return Google_LiveStream
     */
    public function insert ($part, Google_LiveStream $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('insert', array($params));
        if ($this->useObjects()) {
            return new Google_LiveStream($data);
        } else {
            return $data;
        }
    }

    /**
     * Returns a list of video streams that match the API request parameters. (liveStreams.list)
     *
     * @param string $part The part parameter specifies a comma-separated list of one or more liveStream resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, cdn, and status.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string id The id parameter specifies a comma-separated list of YouTube stream IDs that identify the streams being retrieved. In a liveStream resource, the id property specifies the stream's ID.
     * @opt_param string maxResults The maxResults parameter specifies the maximum number of items that should be returned in the result set. Acceptable values are 0 to 50, inclusive. The default value is 5.
     * @opt_param bool mine The mine parameter can be used to instruct the API to only return streams owned by the authenticated user. Set the parameter value to true to only retrieve your own streams.
     * @opt_param string onBehalfOf ID of the Google+ Page for the channel on whose behalf this request is made
     * @opt_param string pageToken The pageToken parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.
     * @return Google_LiveStreamList
     */
    public function listLiveStreams ($part, $optParams = array()) {
        $params = array('part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Google_LiveStreamList($data);
        } else {
            return $data;
        }
    }

    /**
     * Updates a video stream. If the properties that you want to change cannot be updated, then you
     * need to create a new stream with the proper settings. (liveStreams.update)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part properties that you can include in the parameter value are id, snippet, cdn, and status.
      Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. If the request body does not specify a value for a mutable property, the existing value for that property will be removed.
     * @param Google_LiveStream $postBody
     * @param array $optParams Optional parameters.
     * @return Google_LiveStream
     */
    public function update ($part, Google_LiveStream $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('update', array($params));
        if ($this->useObjects()) {
            return new Google_LiveStream($data);
        } else {
            return $data;
        }
    }

}

?>
