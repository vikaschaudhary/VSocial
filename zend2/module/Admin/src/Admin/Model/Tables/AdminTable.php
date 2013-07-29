<?php

namespace Admin\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

class AdminTable {

  protected $tableGateway;
  protected $select;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
    $this->select = new Select();
  }

  public function fetch_all() {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                "user_id", "username", "user_email",
                "password", "first_name", "last_name",
                "gender", "date_of_birth", "isAdmin"
            )
    );
    $select->order('users.user_id DESC');

    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

  public function fetch_user_data($user_id) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                "user_id", "username", "user_email",
                "password", "first_name", "last_name",
                "gender", "date_of_birth", "isAdmin"
            )
    );
    $select->order('users.user_id DESC');
    $select->where(array('user_id' => $user_id));
    $select->limit(1);
    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet->current();
      ;
    }
    return false;
  }

  public function fetch_all_users($query_params = array()) {
    $select = $this->tableGateway->getSql()->select();

    if ($query_params['search_field'] && $query_params['search_key']) {
      $select->where->like("users.{$query_params['search_field']}", "%{$query_params['search_key']}%");
    }

    $select->order("users.{$query_params['order_by']} {$query_params['order']}");

    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

  public function fetch_user($user_id) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                "user_id", "username", "user_email",
                "password", "first_name", "last_name",
                "gender", "date_of_birth", "isAdmin"
            )
    );
    $select->where(array('users.user_id ' => $user_id));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find user with user_id {$user_id}");
    }
    return $row;
  }

  public function getUser($email_address) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'user_id',
                'username', 'first_name',
                'last_name', 'gender',
                'date_of_birth', 'user_email', 'isAdmin',
            )
    );
    $select->join('users_images', 'users.user_id = users_images.user_id', array('image_url', 'image_controls', 'profile_image'), 'left');
    $select->where(array('users.user_email ' => $email_address));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find user with email {$email}");
    }
    return $row;
  }

  public function getUserByEmail($email) {
    $select = $this->tableGateway->getSql()->select();
    $select->where(array('users.user_email ' => $email));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find user with email {$email}");
    }
    return $row;
  }

  public function getUserByUsername($username) {
    $select = $this->tableGateway->getSql()->select();
    $select->where(array('users.username ' => $username));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find user with username {$username}");
    }
    return $row;
  }

  public function delete_user($user_id) {
    if (!$user_id) {
      return false;
    }

    $delete = $this->tableGateway->getSql()->delete();
    $delete->where(array('user_id' => $user_id));

    $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($delete);

    try {
      return $statement->execute();
    } catch (\Exception $e) {
      throw new Exception\RuntimeException($e->getMessage());
    }
    return false;
  }

}

?>
