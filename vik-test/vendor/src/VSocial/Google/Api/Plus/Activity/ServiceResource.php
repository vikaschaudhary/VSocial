<?php
namespace VSocial\Google\Api\Plus\Activity;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;
use VSocial\Google\Api\Plus\Activity\Feed as ActivityFeed;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Get an activity. (activities.get)
     *
     * @param string $activityId The ID of the activity to get.
     * @param array $optParams Optional parameters.
     * @return Google_Activity
     */
    public function get ($activityId, $optParams = array()) {
        $params = array('activityId' => $activityId);
        $params = array_merge($params, $optParams);
        $data = $this->__call('get', array($params));
        if ($this->useObjects()) {
            return new Google_Activity($data);
        } else {
            return $data;
        }
    }

    /**
     * List all of the activities in the specified collection for a particular user. (activities.list)
     *
     * @param string $userId The ID of the user to get activities for. The special value "me" can be used to indicate the authenticated user.
     * @param string $collection The collection of activities to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of activities to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return Google_ActivityFeed
     */
    public function listActivities ($userId, $collection, $optParams = array()) {
        $params = array('userId' => $userId, 'collection' => $collection);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        
        if ($this->useObjects()) {
            return new ActivityFeed($data);
        } else {
            return $data;
        }
    }

    /**
     * Search public activities. (activities.search)
     *
     * @param string $query Full-text search query string.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string language Specify the preferred language to search with. See search language codes for available values.
     * @opt_param string maxResults The maximum number of activities to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string orderBy Specifies how to order search results.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response. This token can be of any length.
     * @return Google_ActivityFeed
     */
    public function search ($query, $optParams = array()) {
        $params = array('query' => $query);
        $params = array_merge($params, $optParams);
        $data = $this->__call('search', array($params));
        if ($this->useObjects()) {
            return new ActivityFeed($data);
        } else {
            return $data;
        }
    }

}

?>
