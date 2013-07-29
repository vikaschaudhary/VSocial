<?php
namespace VSocial\LinkedIn;

use VSocial\LinkedIn\LinkedIn;

class Options {

    protected $linkedin;

    public function __construct (LinkedIn $linkedin) {
        $this->linkedin = $linkedin;
    }

    /**
     * Bookmark a job.
     * 
     * Calling this method causes the current user to add a bookmark for the 
     * specified job:
     * 
     *   http://developer.linkedin.com/docs/DOC-1323
     * 
     * @param str $jid
     *    Job ID you want to bookmark.
     *         	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function bookmarkJob ($jid) {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->bookmarkJob(): bad data passed, $jid must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/job-bookmarks';
        $response = $this->fetch('POST', $query, '<job-bookmark><job><id>' . trim($jid) . '</id></job></job-bookmark>');

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Get list of jobs you have bookmarked.
     * 
     * Returns a list of jobs the current user has bookmarked, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1323   
     * 	
     * @return arr
     *         Array containing retrieval success, LinkedIn response.
     */
    public function bookmarkedJobs () {
        // construct and send the request  
        $query = self::_URL_API . '/v1/people/~/job-bookmarks';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    

    /**
     * Close a job.
     * 
     * Calling this method causes the passed job to be closed, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1151   
     * 
     * @param str $jid
     *    Job ID you want to close.
     *            	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function closeJob ($jid) {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->closeJob(): bad data passed, $jid must be of string value.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/jobs/partner-job-id=' . trim($jid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Share comment posting method.
     * 
     * Post a comment on an existing connections shared content. API details can
     * be found here: 
     * 
     * http://developer.linkedin.com/docs/DOC-1043 
     * 
     * @param str $uid 
     *    The LinkedIn update ID.   	 
     * @param str $comment 
     *    The share comment to be posted.
     *            	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.       	 
     */
    public function comment ($uid, $comment) {
        // check passed data
        if (!is_string($uid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->comment(): bad data passed, $uid must be of type string.');
        }
        if (!is_string($comment)) {
            // nothing/non-string passed, raise an exception
            throw new LinkedInException('LinkedIn->comment(): bad data passed, $comment must be a non-zero length string.');
        }

        /**
         * Share comment rules:
         * 
         * 1) No HTML permitted.
         * 2) Comment cannot be longer than 700 characters.     
         */
        $comment = substr(trim(htmlspecialchars(strip_tags($comment))), 0, self::_SHARE_COMMENT_LENGTH);
        $data = '<?xml version="1.0" encoding="UTF-8"?>
                <update-comment>
  				        <comment>' . $comment . '</comment>
  				      </update-comment>';

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/network/updates/key=' . $uid . '/update-comments';
        $response = $this->fetch('POST', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Share comment retrieval.
     *     
     * Return all comments associated with a given network update:
     * 	 
     *   http://developer.linkedin.com/docs/DOC-1043
     * 
     * @param str $uid
     *    The LinkedIn update ID.
     *                     	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.                  
     */
    public function comments ($uid) {
        // check passed data
        if (!is_string($uid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->comments(): bad data passed, $uid must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/network/updates/key=' . $uid . '/update-comments';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Company profile retrieval function.
     * 
     * Takes a string of parameters as input and requests company profile data 
     * from the LinkedIn Company Profile API. See the official documentation for 
     * $options 'field selector' formatting:
     * 
     *   http://developer.linkedin.com/docs/DOC-1014
     *   http://developer.linkedin.com/docs/DOC-1259   
     * 
     * @param str $options
     *    Data retrieval options.	
     * @param	bool $by_email
     *    [OPTIONAL] Search by email domain?
     * 	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function company ($options, $by_email = FALSE) {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->company(): bad data passed, $options must be of type string.');
        }
        if (!is_bool($by_email)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->company(): bad data passed, $by_email must be of type boolean.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/companies' . ($by_email ? '' : '/') . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Company products and their associated recommendations.
     * 
     * The product data type contains details about a company's product or 
     * service, including recommendations from LinkedIn members, and replies from 
     * company representatives.
     * 
     *   http://developer.linkedin.com/docs/DOC-1327   
     * 
     * @param str $cid
     *    Company ID you want the producte for.	
     * @param str $options
     *    [OPTIONAL] Data retrieval options.
     *            	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function companyProducts ($cid, $options = '') {
        // check passed data
        if (!is_string($cid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->companyProducts(): bad data passed, $cid must be of type string.');
        }
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->companyProducts(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/companies/' . trim($cid) . '/products' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Connection retrieval function.
     * 
     * Takes a string of parameters as input and requests connection-related data 
     * from the Linkedin Connections API. See the official documentation for 
     * $options 'field selector' formatting:
     * 
     *   http://developer.linkedin.com/docs/DOC-1014      	 
     * 
     * @param str $options 
     *    [OPTIONAL] Data retrieval options.
     *            	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function connections ($options = '~/connections') {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->connections(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This creates a post in the specified group with the specified title and specified summary.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * @param str $title
     * 		The title of the post. This must be non-empty.
     * @param str $summary
     * 		[OPTIONAL] The content or summary of the post. This can be empty.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function createPost ($gid, $title, $summary = '') {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->createPost(): bad data passed, $gid must be of type string.');
        }
        if (!is_string($title) || empty($title)) {
            throw new LinkedInException('LinkedIn->createPost(): bad data passed, $title must be a non-empty string.');
        }
        if (!is_string($summary)) {
            throw new LinkedInException('LinkedIn->createPost(): bad data passed, $summary must be of type string.');
        }

        // construct the XML
        $data = '<?xml version="1.0" encoding="UTF-8"?>
    				 <post>
    					 <title>' . $title . '</title>
    					 <summary>' . $summary . '</summary>
    				 </post>';

        // construct and send the request
        $query = self::_URL_API . '/v1/groups/' . trim($gid) . '/posts';
        $response = $this->fetch('POST', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * This deletes the specified post if you are the owner or moderator that post.
     * Otherwise, it just flags the post as inappropriate.
     * 
     * https://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function deletePost ($pid) {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->deletePost(): bad data passed, $pid must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . trim($pid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Edit a job.
     * 
     * Calling this method causes the passed job to be edited, with the passed
     * XML instructing which fields to change, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1154
     *   http://developer.linkedin.com/docs/DOC-1142      
     * 
     * @param str $jid
     *    Job ID you want to renew.
     * @param str $xml
     *    The XML containing the job fields to edit.	 
     *            	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function editJob ($jid, $xml) {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->editJob(): bad data passed, $jid must be of string value.');
        }
        if (is_string($xml)) {
            $xml = trim(stripslashes($xml));
        } else {
            // bad data passed
            throw new LinkedInException('LinkedIn->editJob(): bad data passed, $xml must be of string value.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/jobs/partner-job-id=' . trim($jid);
        $response = $this->fetch('PUT', $query, $xml);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This flags a specified post as specified by type.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * @param str $type
     * 		The type to flag the post as.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function flagPost ($pid, $type) {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->flagPost(): bad data passed, $pid must be of type string');
        }
        if (!is_string($type)) {
            throw new LinkedInException('LinkedIn->flagPost(): bad data passed, $like must be of type string');
        }
        //Constructing the xml
        $data = '<?xml version="1.0" encoding="UTF-8"?>';
        switch ($type) {
            case 'promotion':
                $data .= '<code>promotion</code>';
                break;
            case 'job':
                $data .= '<code>job</code>';
                break;
            default:
                throw new LinkedInException('LinkedIn->flagPost(): invalid value for $type, must be one of: "promotion", "job"');
                break;
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . $pid . '/category/code';
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Follow a company.
     * 
     * Calling this method causes the current user to start following the 
     * specified company, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1324
     * 
     * @param str $cid
     *    Company ID you want to follow.
     *         	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function followCompany ($cid) {
        // check passed data
        if (!is_string($cid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->followCompany(): bad data passed, $cid must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/following/companies';
        $response = $this->fetch('POST', $query, '<company><id>' . trim($cid) . '</id></company>');

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Follows/Unfollows the specified post.
     * 
     * https://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * @param bool $follow
     * 		Determines whether to follow or unfollow the post. TRUE = follow, FALSE = unfollow
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function followPost ($pid, $follow) {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->followPost(): bad data passed, $pid must be of type string');
        }
        if (!($follow === TRUE || $follow === FALSE)) {
            throw new LinkedInException('LinkedIn->followPost(): bad data passed, $follow must be of type boolean');
        }

        // construct the XML
        $data = '<?xml version="1.0" encoding="UTF-8"?>
				     <is-following>' . (($follow) ? 'true' : 'false') . '</is-following>';

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . trim($pid) . '/relation-to-viewer/is-following';
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Get list of companies you follow.
     * 
     * Returns a list of companies the current user is currently following, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1324   
     * 	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function followedCompanies () {
        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/following/companies';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * 
     * Get information about a specific group.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 	 	The group id.
     *  
     * @param str $options
     * 		[OPTIONAL] Field selectors for the group.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function group ($gid, $options = '') {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->group(): bad data passed, $gid must be of type string.');
        }
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->group(): bad data passed, $options must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/groups/' . trim($gid) . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This returns all the groups the user is a member of.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $options
     * 		[OPTIONAL] Field selectors for the groups.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function groupMemberships ($options = '') {
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->groupMemberships(): bad data passed, $options must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/group-memberships' . trim($options) . '?membership-state=member';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This gets a specified post made within a group.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * @param str $options
     * 		[OPTIONAL] Field selectors for the post.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function groupPost ($pid, $options = '') {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->groupPost(): bad data passed, $pid must be of type string.');
        }
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->groupPost(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . trim($pid) . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This returns all the comments made on the specified post within a group.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * @param str $options
     * 		[OPTIONAL] Field selectors for the post comments.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function groupPostComments ($pid, $options = '') {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->groupPostComments(): bad data passed, $pid must be of type string.');
        }
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->groupPostComments(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . trim($pid) . '/comments' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This returns all the posts within a group.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function groupPosts ($gid, $options = '') {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->groupPosts(): bad data passed, $gid must be of type string');
        }
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->groupPosts(): bad data passed, $options must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/groups/' . trim($gid) . '/posts' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This returns the group settings of the specified group
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * @param str $options
     * 		[OPTIONAL] Field selectors for the group.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function groupSettings ($gid, $options = '') {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->groupSettings(): bad data passed, $gid must be of type string');
        }
        if (!is_string($options)) {
            throw new LinkedInException('LinkedIn->groupSettings(): bad data passed, $options must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/group-memberships/' . trim($gid) . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Send connection invitations.
     *     
     * Send an invitation to connect to your network, either by email address or 
     * by LinkedIn ID. Details on the API here: 
     * 
     *   http://developer.linkedin.com/docs/DOC-1012
     * 
     * @param str $method 
     *    The invitation method to process.	 
     * @param str $recipient 
     *    The email/id to send the invitation to.	 	 
     * @param str $subject 
     *    The subject of the invitation to send.
     * @param str $body 
     *    The body of the invitation to send.
     * @param str $type 
     *    [OPTIONAL] The invitation request type (only friend is supported at this time by the Invite API).
     * 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.  	 
     */
    public function invite ($method, $recipient, $subject, $body, $type = 'friend') {
        /**
         * Clean up the passed data per these rules:
         * 
         * 1) Message must be sent to one recipient (only a single recipient permitted for the Invitation API)
         * 2) No HTML permitted
         * 3) 200 characters max in the invitation subject
         * 4) Only able to connect as a friend at this point     
         */
        // check passed data
        if (empty($recipient)) {
            throw new LinkedInException('LinkedIn->invite(): you must provide an invitation recipient.');
        }
        switch ($method) {
            case 'email':
                if (is_array($recipient)) {
                    $recipient = array_map('trim', $recipient);
                } else {
                    // bad format for recipient for email method
                    throw new LinkedInException('LinkedIn->invite(): invitation recipient email/name array is malformed.');
                }
                break;
            case 'id':
                $recipient = trim($recipient);
                if (!self::isId($recipient)) {
                    // bad format for recipient for id method
                    throw new LinkedInException('LinkedIn->invite(): invitation recipient ID does not match LinkedIn format.');
                }
                break;
            default:
                throw new LinkedInException('LinkedIn->invite(): bad invitation method, must be one of: email, id.');
                break;
        }
        if (!empty($subject)) {
            $subject = trim(htmlspecialchars(strip_tags(stripslashes($subject))));
        } else {
            throw new LinkedInException('LinkedIn->invite(): message subject is empty.');
        }
        if (!empty($body)) {
            $body = trim(htmlspecialchars(strip_tags(stripslashes($body))));
            if (strlen($body) > self::_INV_BODY_LENGTH) {
                throw new LinkedInException('LinkedIn->invite(): message body length is too long - max length is ' . self::_INV_BODY_LENGTH . ' characters.');
            }
        } else {
            throw new LinkedInException('LinkedIn->invite(): message body is empty.');
        }
        switch ($type) {
            case 'friend':
                break;
            default:
                throw new LinkedInException('LinkedIn->invite(): bad invitation type, must be one of: friend.');
                break;
        }

        // construct the xml data
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		           <mailbox-item>
		             <recipients>
                   <recipient>';
        switch ($method) {
            case 'email':
                // email-based invitation
                $data .= '<person path="/people/email=' . $recipient['email'] . '">
                                     <first-name>' . htmlspecialchars($recipient['first-name']) . '</first-name>
                                     <last-name>' . htmlspecialchars($recipient['last-name']) . '</last-name>
                                   </person>';
                break;
            case 'id':
                // id-based invitation
                $data .= '<person path="/people/id=' . $recipient . '"/>';
                break;
        }
        $data .= '    </recipient>
                 </recipients>
                 <subject>' . $subject . '</subject>
                 <body>' . $body . '</body>
                 <item-content>
                   <invitation-request>
                     <connect-type>';
        switch ($type) {
            case 'friend':
                $data .= 'friend';
                break;
        }
        $data .= '      </connect-type>';
        switch ($method) {
            case 'id':
                // id-based invitation, we need to get the authorization information
                $query = 'id=' . $recipient . ':(api-standard-profile-request)';
                $response = self::profile($query);
                if ($response['info']['http_code'] == 200) {
                    $response['linkedin'] = self::xmlToArray($response['linkedin']);
                    if ($response['linkedin'] === FALSE) {
                        // bad XML data
                        throw new LinkedInException('LinkedIn->invite(): LinkedIn returned bad XML data.');
                    }
                    $authentication = explode(':', $response['linkedin']['person']['children']['api-standard-profile-request']['children']['headers']['children']['http-header']['children']['value']['content']);

                    // complete the xml        
                    $data .= '<authorization>
                                       <name>' . $authentication[0] . '</name>
                                       <value>' . $authentication[1] . '</value>
                                     </authorization>';
                } else {
                    // bad response from the profile request, not a valid ID?
                    throw new LinkedInException('LinkedIn->invite(): could not send invitation, LinkedIn says: ' . print_r($response['linkedin'], TRUE));
                }
                break;
        }
        $data .= '    </invitation-request>
                 </item-content>
               </mailbox-item>';

        // send request
        $query = self::_URL_API . '/v1/people/~/mailbox';
        $response = $this->fetch('POST', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Job posting detail info retrieval function.
     * 
     * The Jobs API returns detailed information about job postings on LinkedIn. 
     * Find the job summary, description, location, and apply our professional graph 
     * to present the relationship between the current member and the job poster or 
     * hiring manager.
     * 
     *   http://developer.linkedin.com/docs/DOC-1322  
     * 
     * @param	str $jid 
     *    ID of the job you want to look up.
     * @param str $options 
     *    [OPTIONAL] Data retrieval options.
     *            	
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function job ($jid, $options = '') {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->job(): bad data passed, $jid must be of type string.');
        }
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->job(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/jobs/' . trim($jid) . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Join the specified group, per: 
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.   	 
     */
    public function joinGroup ($gid) {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->joinGroup(): bad data passed, $gid must be of type string.');
        }

        // constructing the XML
        $data = '<?xml version="1.0" encoding="UTF-8"?>
  				   <group-membership>
  				   	 <membership-state>
  				  	 	 <code>member</code>
  				  	 </membership-state>
  				   </group-membership>';

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/group-memberships/' . trim($gid);
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 200 or 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(array(200, 201), $response);
    }

    /**
     * Leave the specified group, per:.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function leaveGroup ($gid) {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->leaveGroup(): bad data passed, $gid must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/group-memberships/' . trim($gid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Like another user's network update, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1043
     * 
     * @param str $uid
     *    The LinkedIn update ID.
     *                     	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.                  
     */
    public function like ($uid) {
        // check passed data
        if (!is_string($uid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->like(): bad data passed, $uid must be of type string.');
        }

        // construct the XML
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		         <is-liked>true</is-liked>';

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/network/updates/key=' . $uid . '/is-liked';
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Likes/unlikes the specified post, per:
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $pid
     * 		The post id.
     * @param bool $like
     * 		Determines whether to like or unlike. TRUE = like, FALSE = unlike.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function likePost ($pid, $like) {
        if (!is_string($pid)) {
            throw new LinkedInException('LinkedIn->likePost(): bad data passed, $pid must be of type string');
        }
        if (!($like === TRUE || $like === FALSE)) {
            throw new LinkedInException('LinkedIn->likePost(): bad data passed, $like must be of type boolean');
        }

        // construct the XML
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		         <is-liked>' . (($like) ? 'true' : 'false') . '</is-liked>';

        // construct and send the request
        $query = self::_URL_API . '/v1/posts/' . trim($pid) . '/relation-to-viewer/is-liked';
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Retrieve network update likes.
     *    
     * Return all likes associated with a given network update:
     * 
     * http://developer.linkedin.com/docs/DOC-1043
     * 
     * @param str $uid
     *    The LinkedIn update ID.
     *                     	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.                  
     */
    public function likes ($uid) {
        // check passed data
        if (!is_string($uid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->likes(): bad data passed, $uid must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/network/updates/key=' . $uid . '/likes';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Connection messaging method.
     * 	 
     * Send a message to your network connection(s), optionally copying yourself.  
     * Full details from LinkedIn on this functionality can be found here: 
     * 
     *   http://developer.linkedin.com/docs/DOC-1044
     * 
     * @param arr $recipients 
     *    The connection(s) to send the message to.	 	 
     * @param str $subject 
     *    The subject of the message to send.
     * @param str $body 
     *    The body of the message to send.
     * @param bool $copy_self 
     *    [OPTIONAL] Also update the teathered Twitter account.
     *    	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.      	 
     */
    public function message ($recipients, $subject, $body, $copy_self = FALSE) {
        /**
         * Clean up the passed data per these rules:
         * 
         * 1) Message must be sent to at least one recipient
         * 2) No HTML permitted
         */
        if (!empty($subject) && is_string($subject)) {
            $subject = trim(strip_tags(stripslashes($subject)));
        } else {
            throw new LinkedInException('LinkedIn->message(): bad data passed, $subject must be of type string.');
        }
        if (!empty($body) && is_string($body)) {
            $body = trim(strip_tags(stripslashes($body)));
        } else {
            throw new LinkedInException('LinkedIn->message(): bad data passed, $body must be of type string.');
        }
        if (!is_array($recipients) || count($recipients) < 1) {
            // no recipients, and/or bad data
            throw new LinkedInException('LinkedIn->message(): at least one message recipient required.');
        }

        // construct the xml data
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		           <mailbox-item>
		             <recipients>';
        $data .= ($copy_self) ? '<recipient><person path="/people/~"/></recipient>' : '';
        for ($i = 0; $i < count($recipients); $i++) {
            if (is_string($recipients[$i])) {
                $data .= '<recipient><person path="/people/' . trim($recipients[$i]) . '"/></recipient>';
            } else {
                throw new LinkedInException('LinkedIn->message(): bad data passed, $recipients must be an array of type string.');
            }
        }
        $data .= '  </recipients>
                 <subject>' . htmlspecialchars($subject) . '</subject>
                 <body>' . htmlspecialchars($body) . '</body>
               </mailbox-item>';

        // send request
        $query = self::_URL_API . '/v1/people/~/mailbox';
        $response = $this->fetch('POST', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Job posting method.
     * 	 
     * Post a job to LinkedIn, assuming that you have access to this feature. 
     * Full details from LinkedIn on this functionality can be found here: 
     * 
     *   http://developer.linkedin.com/community/jobs?view=documents
     * 
     * @param str $xml 
     *    The XML defining a job to post.	 	 
     *    	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.      	 
     */
    public function postJob ($xml) {
        // check passed data
        if (is_string($xml)) {
            $xml = trim(stripslashes($xml));
        } else {
            throw new LinkedInException('LinkedIn->postJob(): bad data passed, $xml must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/jobs';
        $response = $this->fetch('POST', $query, $xml);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * This removes the specified group from the group suggestions, per:
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function removeSuggestedGroup ($gid) {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->removeSuggestedGroup(): bad data passed, $gid must be of type string');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/suggestions/groups/' . trim($gid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Renew a job.
     * 
     * Calling this method causes the passed job to be renewed, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1154   
     * 
     * @param str $jid
     *    Job ID you want to renew.
     * @param str $cid
     *    Contract ID that covers the passed Job ID.	 
     *            	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function renewJob ($jid, $cid) {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->renewJob(): bad data passed, $jid must be of string value.');
        }
        if (!is_string($cid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->renewJob(): bad data passed, $cid must be of string value.');
        }

        // construct the xml data
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		           <job>
		             <contract-id>' . trim($cid) . '</contract-id>
                 <renewal/>
               </job>';

        // construct and send the request
        $query = self::_URL_API . '/v1/jobs/partner-job-id=' . trim($jid);
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * [DEPRECATED] General people search function.
     * 
     * Takes a string of parameters as input and requests profile data from the 
     * Linkedin People Search API.  See the official documentation for $options
     * querystring formatting:
     * 
     *   http://developer.linkedin.com/docs/DOC-1191 
     * 
     * @param str $options 
     *    [OPTIONAL] Data retrieval options.
     *            	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function search ($options = NULL) {
        return searchPeople($options);
    }

    /**
     * Company search.
     * 
     * Uses the Company Search API to find companies using keywords, industry, 
     * location, or some other criteria. It returns a collection of matching 
     * companies.
     * 
     *   http://developer.linkedin.com/docs/DOC-1325  
     * 
     * @param str $options
     *    [OPTIONAL] Search options.	
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function searchCompanies ($options = '') {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->searchCompanies(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/company-search' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Jobs search.
     * 
     * Use the Job Search API to find jobs using keywords, company, location, 
     * or some other criteria. It returns a collection of matching jobs. Each 
     * entry can contain much of the information available on the job listing.
     * 
     *   http://developer.linkedin.com/docs/DOC-1321  
     * 
     * @param str $options 
     *    [OPTIONAL] Data retrieval options.
     *            	
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function searchJobs ($options = '') {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->jobsSearch(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/job-search' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * General people search function.
     * 
     * Takes a string of parameters as input and requests profile data from the 
     * Linkedin People Search API.  See the official documentation for $options
     * querystring formatting:
     * 
     *   http://developer.linkedin.com/docs/DOC-1191 
     * 
     * @param str $options 
     *    [OPTIONAL] Data retrieval options.
     *            	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.
     */
    public function searchPeople ($options = NULL) {
        // check passed data
        if (!is_null($options) && !is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->search(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people-search' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * This sets the group settings of the specified group.
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @param str $gid
     * 		The group id.
     * @param str $xml
     * 		The group settings to set. The settings are:
     * 		  -<show-group-logo-in-profle>
     * 		  -<contact-email>
     * 		  -<email-digest-frequency>
     * 		  -<email-annoucements-from-managers>
     * 		  -<allow-messages-from-members>
     * 		  -<email-for-every-new-post>
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function setGroupSettings ($gid, $xml) {
        if (!is_string($gid)) {
            throw new LinkedInException('LinkedIn->setGroupSettings(): bad data passed, $token_access should be in array format.');
        }
        if (!is_string($xml)) {
            throw new LinkedInException('LinkedIn->setGroupSettings(): bad data passed, $token_access should be in array format.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/group-memberships/' . trim($gid);
        $response = $this->fetch('PUT', $query, $xml);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Post a share. 
     * 
     * Create a new or reshare another user's shared content. Full details from 
     * LinkedIn on this functionality can be found here: 
     * 
     *   http://developer.linkedin.com/docs/DOC-1212 
     * 
     *   $action values: ('new', 'reshare')      	 
     *   $content format: 
     *     $action = 'new'; $content => ('comment' => 'xxx', 'title' => 'xxx', 'submitted-url' => 'xxx', 'submitted-image-url' => 'xxx', 'description' => 'xxx')
     *     $action = 'reshare'; $content => ('comment' => 'xxx', 'id' => 'xxx')	 
     * 
     * @param str $action
     *    The sharing action to perform.	 
     * @param str $content
     *    The share content.
     * @param bool $private 
     *    [OPTIONAL] Should we restrict this shared item to connections only?	 
     * @param bool $twitter 
     *    [OPTIONAL] Also update the teathered Twitter account.
     *    	 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.      	 
     */
    public function share ($action, $content, $private = TRUE, $twitter = FALSE) {
        // check the status itself
        if (!empty($action) && !empty($content)) {
            /**
             * Status is not empty, wrap a cleaned version of it in xml.  Status
             * rules:
             * 
             * 1) Comments are 700 chars max (if this changes, change _SHARE_COMMENT_LENGTH constant)
             * 2) Content/title 200 chars max (if this changes, change _SHARE_CONTENT_TITLE_LENGTH constant)
             * 3) Content/description 400 chars max (if this changes, change _SHARE_CONTENT_DESC_LENGTH constant)
             * 4a) New shares must contain a comment and/or (content/title and content/submitted-url)
             * 4b) Reshared content must contain an attribution id.
             * 4c) Reshared content must contain actual content, not just a comment.             
             * 5) No HTML permitted in comment, content/title, content/description.
             */
            // prepare the share data per the rules above
            $share_flag = FALSE;
            $content_xml = NULL;
            switch ($action) {
                case 'new':
                    // share can be an article
                    if (array_key_exists('title', $content) && array_key_exists('submitted-url', $content)) {
                        // we have shared content, format it as needed per rules above
                        $content_title = trim(htmlspecialchars(strip_tags(stripslashes($content['title']))));
                        if (strlen($content_title) > self::_SHARE_CONTENT_TITLE_LENGTH) {
                            throw new LinkedInException('LinkedIn->share(): title length is too long - max length is ' . self::_SHARE_CONTENT_TITLE_LENGTH . ' characters.');
                        }
                        $content_xml .= '<content>
                               <title>' . $content_title . '</title>
                               <submitted-url>' . trim(htmlspecialchars($content['submitted-url'])) . '</submitted-url>';
                        if (array_key_exists('submitted-image-url', $content)) {
                            $content_xml .= '<submitted-image-url>' . trim(htmlspecialchars($content['submitted-image-url'])) . '</submitted-image-url>';
                        }
                        if (array_key_exists('description', $content)) {
                            $content_desc = trim(htmlspecialchars(strip_tags(stripslashes($content['description']))));
                            if (strlen($content_desc) > self::_SHARE_CONTENT_DESC_LENGTH) {
                                throw new LinkedInException('LinkedIn->share(): description length is too long - max length is ' . self::_SHARE_CONTENT_DESC_LENGTH . ' characters.');
                            }
                            $content_xml .= '<description>' . $content_desc . '</description>';
                        }
                        $content_xml .= '</content>';

                        $share_flag = TRUE;
                    }

                    // share can be just a comment
                    if (array_key_exists('comment', $content)) {
                        // comment located
                        $comment = htmlspecialchars(trim(strip_tags(stripslashes($content['comment']))));
                        if (strlen($comment) > self::_SHARE_COMMENT_LENGTH) {
                            throw new LinkedInException('LinkedIn->share(): comment length is too long - max length is ' . self::_SHARE_COMMENT_LENGTH . ' characters.');
                        }
                        $content_xml .= '<comment>' . $comment . '</comment>';

                        $share_flag = TRUE;
                    }
                    break;
                case 'reshare':
                    if (array_key_exists('id', $content)) {
                        // put together the re-share attribution XML
                        $content_xml .= '<attribution>
                               <share>
                                 <id>' . trim($content['id']) . '</id>
                               </share>
                             </attribution>';

                        // optional additional comment
                        if (array_key_exists('comment', $content)) {
                            // comment located
                            $comment = htmlspecialchars(trim(strip_tags(stripslashes($content['comment']))));
                            if (strlen($comment) > self::_SHARE_COMMENT_LENGTH) {
                                throw new LinkedInException('LinkedIn->share(): comment length is too long - max length is ' . self::_SHARE_COMMENT_LENGTH . ' characters.');
                            }
                            $content_xml .= '<comment>' . $comment . '</comment>';
                        }

                        $share_flag = TRUE;
                    }
                    break;
                default:
                    // bad action passed
                    throw new LinkedInException('LinkedIn->share(): share action is an invalid value, must be one of: share, reshare.');
                    break;
            }

            // should we proceed?
            if ($share_flag) {
                // put all of the xml together
                $visibility = ($private) ? 'connections-only' : 'anyone';
                $data = '<?xml version="1.0" encoding="UTF-8"?>
                       <share>
                         ' . $content_xml . '
                         <visibility>
                           <code>' . $visibility . '</code>
                         </visibility>
                       </share>';

                // create the proper url
                $share_url = self::_URL_API . '/v1/people/~/shares';
                if ($twitter) {
                    // update twitter as well
                    $share_url .= '?twitter-post=true';
                }

                // send request
                $response = $this->fetch('POST', $share_url, $data);
            } else {
                // data contraints/rules not met, raise an exception
                throw new LinkedInException('LinkedIn->share(): sharing data constraints not met; check that you have supplied valid content and combinations of content to share.');
            }
        } else {
            // data missing, raise an exception
            throw new LinkedInException('LinkedIn->share(): sharing action or shared content is missing.');
        }

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Companies you may want to follow.
     * 
     * Returns a list of companies the current user may want to follow, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1324   
     * 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function suggestedCompanies () {
        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/suggestions/to-follow/companies';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Retrieves suggested groups for the user, per:
     * 
     *   http://developer.linkedin.com/documents/groups-api
     * 
     * @return arr
     * 		Array containing retrieval success, LinkedIn response.
     */
    public function suggestedGroups () {
        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/suggestions/groups:(id,name,is-open-to-non-members)';
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Jobs you may be interested in.
     * 
     * Returns a list of jobs the current user may be interested in, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1323   
     * 
     * @param str $options
     *    [OPTIONAL] Data retrieval options.	
     *          	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function suggestedJobs ($options = ':(jobs)') {
        // check passed data
        if (!is_string($options)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->suggestedJobs(): bad data passed, $options must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/suggestions/job-suggestions' . trim($options);
        $response = $this->fetch('GET', $query);

        /**
         * Check for successful request (a 200 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(200, $response);
    }

    /**
     * Unbookmark a job.
     * 
     * Calling this method causes the current user to remove a bookmark for the 
     * specified job:
     * 
     *   http://developer.linkedin.com/docs/DOC-1323   
     * 
     * @param str $jid
     *    Job ID you want to unbookmark.
     *            	
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function unbookmarkJob ($jid) {
        // check passed data
        if (!is_string($jid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->unbookmarkJob(): bad data passed, $jid must be of type string.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/job-bookmarks/' . trim($jid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Unfollow a company.
     * 
     * Calling this method causes the current user to stop following the specified 
     * company, per:
     * 
     *   http://developer.linkedin.com/docs/DOC-1324   
     * 
     * @param str $cid
     *    Company ID you want to unfollow.	
     *         	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.
     */
    public function unfollowCompany ($cid) {
        // check passed data
        if (!is_string($cid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->unfollowCompany(): bad data passed, $cid must be of string value.');
        }

        // construct and send the request
        $query = self::_URL_API . '/v1/people/~/following/companies/id=' . trim($cid);
        $response = $this->fetch('DELETE', $query);

        /**
         * Check for successful request (a 204 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(204, $response);
    }

    /**
     * Unlike a network update.
     *     
     * Unlike another user's network update:
     * 
     *   http://developer.linkedin.com/docs/DOC-1043
     * 
     * @param str $uid 
     *    The LinkedIn update ID.
     *                     	 
     * @return arr
     *    Array containing retrieval success, LinkedIn response.                  
     */
    public function unlike ($uid) {
        // check passed data
        if (!is_string($uid)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->unlike(): bad data passed, $uid must be of type string.');
        }

        // construct the xml data
        $data = '<?xml version="1.0" encoding="UTF-8"?>
		         <is-liked>false</is-liked>';

        // send request
        $query = self::_URL_API . '/v1/people/~/network/updates/key=' . $uid . '/is-liked';
        $response = $this->fetch('PUT', $query, $data);

        /**
         * Check for successful request (a 201 response from LinkedIn server) 
         * per the documentation linked in method comments above.
         */
        return $this->checkResponse(201, $response);
    }

    /**
     * Post network update.
     * 
     * Update the user's Linkedin network status. Full details from LinkedIn 
     * on this functionality can be found here: 
     * 
     *   http://developer.linkedin.com/docs/DOC-1009
     *   http://developer.linkedin.com/docs/DOC-1009#comment-1077 
     * 
     * @param str $update
     *    The network update.	 
     * 
     * @return arr 
     *    Array containing retrieval success, LinkedIn response.       	 
     */
    public function updateNetwork ($update) {
        // check passed data
        if (!is_string($update)) {
            // nothing/non-string passed, raise an exception
            throw new LinkedInException('LinkedIn->updateNetwork(): bad data passed, $update must be a non-zero length string.');
        }

        /**
         * Network update is not empty, wrap a cleaned version of it in xml.  
         * Network update rules:
         * 
         * 1) No HTML permitted except those found in _NETWORK_HTML constant
         * 2) Update cannot be longer than 140 characters.     
         */
        // get the user data
        $response = self::profile('~:(first-name,last-name,site-standard-profile-request)');
        if ($response['success'] === TRUE) {
            /**
             * We are converting response to usable data.  I'd use SimpleXML here, but
             * to keep the class self-contained, we will use a portable XML parsing
             * routine, self::xmlToArray.       
             */
            $person = self::xmlToArray($response['linkedin']);
            if ($person === FALSE) {
                // bad xml data
                throw new LinkedInException('LinkedIn->updateNetwork(): LinkedIn returned bad XML data.');
            }
            $fields = $person['person']['children'];

            // prepare user data
            $first_name = trim($fields['first-name']['content']);
            $last_name = trim($fields['last-name']['content']);
            $profile_url = trim($fields['site-standard-profile-request']['children']['url']['content']);

            // create the network update 
            $update = trim(htmlspecialchars(strip_tags($update, self::_NETWORK_HTML)));
            if (strlen($update) > self::_NETWORK_LENGTH) {
                throw new LinkedInException('LinkedIn->share(): update length is too long - max length is ' . self::_NETWORK_LENGTH . ' characters.');
            }
            $user = htmlspecialchars('<a href="' . $profile_url . '">' . $first_name . ' ' . $last_name . '</a>');
            $data = '<activity locale="en_US">
    				       <content-type>linkedin-html</content-type>
    				       <body>' . $user . ' ' . $update . '</body>
    				     </activity>';

            // send request
            $query = self::_URL_API . '/v1/people/~/person-activities';
            $response = $this->fetch('POST', $query, $data);

            /**
             * Check for successful request (a 201 response from LinkedIn server) 
             * per the documentation linked in method comments above.
             */
            return $this->checkResponse(201, $response);
        } else {
            // profile retrieval failed
            throw new LinkedInException('LinkedIn->updateNetwork(): profile data could not be retrieved.');
        }
    }

}

?>
