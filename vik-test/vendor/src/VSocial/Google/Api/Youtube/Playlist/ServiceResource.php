<?php
namespace VSocial\Google\Api\Youtube\Playlist;

use VSocial\Google\Service\ServiceResource as GoogleServiceResource;

class ServiceResource
        extends GoogleServiceResource {

    /**
     * Deletes a playlist. (playlists.delete)
     *
     * @param string $id The id parameter specifies the YouTube playlist ID for the playlist that is being deleted. In a playlist resource, the id property specifies the playlist's ID.
     * @param array $optParams Optional parameters.
     */
    public function delete ($id, $optParams = array()) {
        $params = array('id' => $id);
        $params = array_merge($params, $optParams);
        $data = $this->__call('delete', array($params));
        return $data;
    }

    /**
     * Creates a playlist. (playlists.insert)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part names that you can include in the parameter value are snippet and status.
     * @param Google_Playlist $postBody
     * @param array $optParams Optional parameters.
     * @return Google_Playlist
     */
    public function insert ($part, Google_Playlist $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('insert', array($params));
        if ($this->useObjects()) {
            return new Google_Playlist($data);
        } else {
            return $data;
        }
    }

    /**
     * Returns a collection of playlists that match the API request parameters. For example, you can
     * retrieve all playlists that the authenticated user owns, or you can retrieve one or more
     * playlists by their unique IDs. (playlists.list)
     *
     * @param string $part The part parameter specifies a comma-separated list of one or more playlist resource properties that the API response will include. The part names that you can include in the parameter value are id, snippet, and status.
      If the parameter identifies a property that contains child properties, the child properties will be included in the response. For example, in a playlist resource, the snippet property contains properties like author, title, description, tags, and timeCreated. As such, if you set part=snippet, the API response will contain all of those properties.
     * @param array $optParams Optional parameters.
     *
     * @opt_param string channelId This value indicates that the API should only return the specified channel's playlists.
     * @opt_param string id The id parameter specifies a comma-separated list of the YouTube playlist ID(s) for the resource(s) that are being retrieved. In a playlist resource, the id property specifies the playlist's YouTube playlist ID.
     * @opt_param string maxResults USE_DESCRIPTION --- channels:list:maxResults
     * @opt_param bool mine Set this parameter's value to true to instruct the API to only return playlists owned by the authenticated user.
     * @opt_param string pageToken USE_DESCRIPTION --- channels:list:pageToken
     * @return Google_PlaylistListResponse
     */
    public function listPlaylists ($part, $optParams = array()) {
        $params = array('part' => $part);
        $params = array_merge($params, $optParams);
        $data = $this->__call('list', array($params));
        if ($this->useObjects()) {
            return new Google_PlaylistListResponse($data);
        } else {
            return $data;
        }
    }

    /**
     * Modifies a playlist. For example, you could change a playlist's title, description, or privacy
     * status. (playlists.update)
     *
     * @param string $part The part parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response will include.
      The part names that you can include in the parameter value are snippet and status.
      Note that this method will override the existing values for all of the mutable properties that are contained in any parts that the parameter value specifies. For example, a playlist's privacy setting is contained in the status part. As such, if your request is updating a private playlist, and the request's part parameter value includes the status part, the playlist's privacy setting will be updated to whatever value the request body specifies. If the request body does not specify a value, the existing privacy setting will be removed and the playlist will revert to the default privacy setting.
     * @param Google_Playlist $postBody
     * @param array $optParams Optional parameters.
     * @return Google_Playlist
     */
    public function update ($part, Google_Playlist $postBody, $optParams = array()) {
        $params = array('part' => $part, 'postBody' => $postBody);
        $params = array_merge($params, $optParams);
        $data = $this->__call('update', array($params));
        if ($this->useObjects()) {
            return new Google_Playlist($data);
        } else {
            return $data;
        }
    }

}

?>
