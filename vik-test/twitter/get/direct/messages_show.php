<?php

/**
 * GET direct_messages/show
 * @desc Returns a single direct message, specified by an id parameter. Like the 
 * /1.1/direct_messages.format request, this method will include the user objects of the 
 * sender and recipient.
 * Important: This method requires an access token with RWD (read, write & direct message) 
 * permissions. Consult The Application Permission Model for more information.
 */
?>
<?php

$params = array();
/**
 * @param id required
 * The ID of the direct message.
 */
$params['id'] = 12145;
?>