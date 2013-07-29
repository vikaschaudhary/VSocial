<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;
use VSocial\Google\Api\Youtube\Video;
use VSocial\Google\Api\Youtube\Video\ListResponse;
class ServiceResource
        extends GoogleServiceResource {

    /**
     * Deletes a YouTube video. (videos.delete)
     *
     * @param string $id The id parameter specifies the YouTube video ID for the resource that is being deleted. In a video resource, the id property specifies the video's ID.
     * @param array $optParams Optional parameters.
     */
    public function delete ($id, $optParams = array()) {
        $params = array('id' => $id);
        $params = array_merge($params, $optParams);
        $data = $this->__call('delete', array($params));
        return $data;
    }

    /**
     * Uploads a video to YouTube and optionally sets the video's metadata. (videos.insert)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part names that you can include in the parameter value are snippet, contentDetails, player, statistics, status, and topicDetails. However, not all of those parts contain properties that can be set when setting or updating a video's metadata. For example, the statistics object encapsulates statistics that YouTube calculates for a video and does not contain values that you can set or modify. If the parameter value specifies a part that does not contain mutable values, that part will still be included in the API response.
     * @param Google_Video $postBody
     * @param array $optParams Optional parameters.
     * @return Google_Video
     */
    public function insert ($part, Video $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('insert', array($params));
        if ($this->useObjects()) {
            return new Video($data);
        } else {
            return $data;
        }
    }

    /**
     * Returns a list of videos that match the API request parameters. (videos.list)
     *
     * @param string $id The id parameter specifies a comma-separated list of the YouTube video ID(s) for the resource(s) that are being retrieved. In a video resource, the id property specifies the video's ID.
     * @param string $part The part parameter specifies a comma-separated list of one or more video resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, player, statistics, status, and topicDetails.
      If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a video resource, the snippet property contains the channelId, title, description, tags, and categoryId properties. As such, if you set part=snippet, the API response will contain all of those properties.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string onBehalfOfContentOwner The onBehalfOfContentOwner parameter indicates that the authenticated user is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with needs to be linked to the specified YouTube content owner.
     * @return Google_VideoListResponse
     */
    public function listVideos ($id, $part, $optParams = array()) {
        $params = array('id' => $id, 'part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new ListResponse($data);
        } else {
            return $data;
        }
    }

    /**
     * Like, dislike, or remove rating from a video. (videos.rate)
     *
     * @param string $id The id parameter specifies the YouTube video ID.
     * @param string $rating Specifies the rating to record.
     * @param array $optParams Optional parameters.
     */
    public function rate ($id, $rating, $optParams = array()) {
        $params = array('id' => $id, 'rating' => $rating);
        $params = array_merge($params, $optParams);
        $data = $this->__call('rate', array($params));
        return $data;
    }

    /**
     * Updates a video's metadata. (videos.update)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part names that you can include in the parameter value are snippet, contentDetails, player, statistics, status, and topicDetails.
      Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. For example, a video's privacy setting is contained in the status part. As such, if your request is updating a private video, and the request's part parameter value includes the status part, the video's privacy setting will be updated to whatever value the request body specifies. If the request body does not specify a value, the existing privacy setting will be removed and the video will revert to the default privacy setting.
      In addition, not all of those parts contain properties that can be set when setting or updating a video's metadata. For example, the statistics object encapsulates statistics that YouTube calculates for a video and does not contain values that you can set or modify. If the parameter value specifies a part that does not contain mutable values, that part will still be included in the API response.
     * @param Google_Video $postBody
     * @param array $optParams Optional parameters.
     * @return Google_Video
     */
    public function update ($part, Video $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('update', array($params));
        if ($this->useObjects()) {
            return new Video($data);
        } else {
            return $data;
        }
    }

}

?>
