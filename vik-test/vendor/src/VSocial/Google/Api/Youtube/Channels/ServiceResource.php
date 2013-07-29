<?php
namespace VSocial\Google\Api\Youtube\Channels;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Returns a collection of zero or more channel resources that match the request criteria.
     * (channels.list)
     *
     * @param string $part The part parameter specifies a comma-separated list of one or more channel resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, contentDetails, statistics, and topicDetails.
      If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a channel resource, the contentDetails property contains other properties, such as the uploads properties. As such, if you set part=contentDetails, the API response will also contain all of those nested properties.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string categoryId The categoryId parameter specifies a YouTube guide category, thereby requesting YouTube channels associated with that category.
     * @opt_param string id The id parameter specifies a comma-separated list of the YouTube channel ID(s) for the resource(s) that are being retrieved. In a channel resource, the id property specifies the channel's YouTube channel ID.
     * @opt_param bool managedByMe Set this parameter's value to true to instruct the API to only return channels managed by the content owner that the onBehalfOfContentOwner parameter specifies. The user must be authenticated as a CMS account linked to the specified content owner and onBehalfOfContentOwner must be provided.
     * @opt_param string maxResults The maxResults parameter specifies the maximum number of items that should be returned in the result set.
     * @opt_param bool mine Set this parameter's value to true to instruct the API to only return channels owned by the authenticated user.
     * @opt_param string mySubscribers Set this parameter's value to true to retrieve a list of channels that subscribed to the authenticated user's channel.
     * @opt_param string onBehalfOfContentOwner The onBehalfOfContentOwner parameter indicates that the authenticated user is acting on behalf of the content owner specified in the parameter value. This parameter is intended for YouTube content partners that own and manage many different YouTube channels. It allows content owners to authenticate once and get access to all their video and channel data, without having to provide authentication credentials for each individual channel. The actual CMS account that the user authenticates with needs to be linked to the specified YouTube content owner.
     * @opt_param string pageToken The pageToken parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.
     * @return Google_ChannelListResponse
     */
    public function listChannels ($part, $optParams = array()) {
        $params = array('part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Google_ChannelListResponse($data);
        } else {
            return $data;
        }
    }

}

?>
