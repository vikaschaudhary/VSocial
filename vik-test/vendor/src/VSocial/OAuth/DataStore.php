<?php

namespace VSocial\OAuth;

class DataStore {
    
    /**
     * @return type Description
     */
    public function __construct () {
        ;
    }

    /**
     * 
     * @param type $consumer_key
     * @return type Description
     */
    public function lookup_consumer ($consumer_key) {
        
    }

    /**
     * 
     * @param type $consumer
     * @param type $token_type
     * @param type $token
     * @return type Description
     */
    public function lookup_token ($consumer, $token_type, $token) {
        
    }

    /**
     * 
     * @param type $consumer
     * @param type $token
     * @param type $nonce
     * @param type $timestamp
     * @return type Description
     */
    public function lookup_nonce ($consumer, $token, $nonce, $timestamp) {
       
    }

    /**
     * return a new token attached to this consumer
     * 
     * @param type $consumer
     * @param type $callback
     * @return type Description
     */
    public function new_request_token ($consumer, $callback = null) {
        
    }

    /**
     * return a new access token attached to this consumer for the user associated with this token if 
     * the request token is authorized should also invalidate the request token
     * 
     * @param type $token
     * @param type $consumer
     * @param type $verifier
     * 
     * @return type Description
     */
    public function new_access_token ($token, $consumer, $verifier = null) {
        
    }

}

?>
