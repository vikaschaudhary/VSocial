<?php
namespace VSocial\Google\Auth;

use VSocial\Google\Auth\AuthException;

class LoginTicket {

    const USER_ATTR = "id";

    private $envelope;
    private $payload;

    public function __construct ($envelope, $payload) {
        $this->envelope = $envelope;
        $this->payload = $payload;
    }

    public function getUserId () {
        if (array_key_exists(self::USER_ATTR, $this->payload)) {
            return $this->payload[self::USER_ATTR];
        }
        throw new AuthException("No user_id in token");
    }

    public function getAttributes () {
        return array("envelope" => $this->envelope, "payload" => $this->payload);
    }

}
