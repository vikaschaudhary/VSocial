<?php
namespace VSocial\Google\Cache;

abstract class Cache {

    /**
     * Retrieves the data for the given key, or false if they
     * key is unknown or expired
     *
     * @param String $key The key who's data to retrieve
     * @param boolean|int $expiration Expiration time in seconds
     *
     */
    abstract function get ($key, $expiration = false);

    /**
     * Store the key => $value set. The $value is serialized
     * by this function so can be of any type
     *
     * @param string $key Key of the data
     * @param string $value data
     */
    abstract function set ($key, $value);

    /**
     * Removes the key/data pair for the given $key
     *
     * @param String $key
     */
    abstract function delete ($key);
}

