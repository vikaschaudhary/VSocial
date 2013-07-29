<?php

namespace Admin\Model;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Adapter\DbTable as AuthAdapter,
    Zend\Authentication\Result as Result;

class Authenticate {

  protected $dbAdapter;
  protected $table = "users";
  protected $identityCol = "user_email";
  protected $credentialCol = "password";

  public function __construct($sm) {
    $this->dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
  }

  public function authenticate($post) {

    // create auth adapter
    $authAdapter = new AuthAdapter($this->dbAdapter);

    // configure auth adapter
    $authAdapter->setTableName($this->table)
            ->setIdentityColumn($this->identityCol)
            ->setCredentialColumn($this->credentialCol);

    // pass authentication information to auth adapter
    $authAdapter->setIdentity($post->get('email'))
            ->setCredential(md5($post->get('password')));
    // create auth service and set adapter
    // auth services provides storage after authenticate
    $authService = new AuthenticationService();
    $authService->setAdapter($authAdapter);

    // authenticate
    $result = $authService->authenticate();
    $success = false;
    $message = null;
    if ($result->isValid()) {
      $success = true;
    } else {
      switch ($result->getCode()) {
        case Result::FAILURE_IDENTITY_NOT_FOUND:
          $message = "Credientials Not Found";
          /** do stuff for nonexistent identity * */
          break;

        case Result::FAILURE_CREDENTIAL_INVALID:
          $message = "Invalid Credientials";
          break;

        case Result::SUCCESS:
          $message = "Authentication success";
          break;

        default:
          $message = null;
          break;
      }
    }

    return array(
        "success" => $success,
        "message" => $message,
    );
  }

  public static function getAuthentication() {
    return new AuthenticationService();
  }

}

?>
