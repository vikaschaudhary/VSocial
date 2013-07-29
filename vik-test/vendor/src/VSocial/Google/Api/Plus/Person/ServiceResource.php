<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;
use VSocial\Google\Api\Plus\Person;
use VSocial\Google\Api\Plus\Person\Feed as PeopleFeed;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Get a person's profile. If your app uses scope https://www.googleapis.com/auth/plus.login, this
     * method is guaranteed to return ageRange and language. (people.get)
     *
     * @param string $userId The ID of the person to get the profile for. The special value "me" can be used to indicate the authenticated user.
     * @param array $optParams Optional parameters.
     * @return Google_Person
     */
    public function get ($userId, $optParams = array()) {
        $params = array('userId' => $userId);
        $params = array_merge($params, $optParams);
        $data = $this->__call('get', array($params));
        if ($this->useObjects()) {
            return new Person($data);
        } else {
            return $data;
        }
    }

    /**
     * List all of the people in the specified collection. (people.list)
     *
     * @param string $userId Get the collection of people for the person identified. Use "me" to indicate the authenticated user.
     * @param string $collection The collection of people to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string orderBy The order to return people in.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return Google_PeopleFeed
     */
    public function listPeople ($userId, $collection=null, $optParams = array()) {
        $params = array('userId' => $userId, 'collection' => $collection);
        $params = array_filter(array_merge($params, $optParams));
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new PeopleFeed($data);
        } else {
            return $data;
        }
    }

    /**
     * List all of the people in the specified collection for a particular activity.
     * (people.listByActivity)
     *
     * @param string $activityId The ID of the activity to get the list of people for.
     * @param string $collection The collection of people to list.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response.
     * @return Google_PeopleFeed
     */
    public function listByActivity ($activityId, $collection, $optParams = array()) {
        $params = array('activityId' => $activityId, 'collection' => $collection);
        $params = array_merge($params, $optParams);
        $data = $this->__call('listByActivity', array($params));
        if ($this->useObjects()) {
            return new PeopleFeed($data);
        } else {
            return $data;
        }
    }

    /**
     * Search all public profiles. (people.search)
     *
     * @param string $query Specify a query string for full text search of public text in all profiles.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string language Specify the preferred language to search with. See search language codes for available values.
     * @opt_param string maxResults The maximum number of people to include in the response, which is used for paging. For any response, the actual number returned might be less than the specified maxResults.
     * @opt_param string pageToken The continuation token, which is used to page through large result sets. To get the next page of results, set this parameter to the value of "nextPageToken" from the previous response. This token can be of any length.
     * @return Google_PeopleFeed
     */
    public function search ($query, $optParams = array()) {
        $params = array('query' => $query);
        $params = array_merge($params, $optParams);
        $data = $this->__call('search', array($params));
        if ($this->useObjects()) {
            return new PeopleFeed($data);
        } else {
            return $data;
        }
    }

}

?>
