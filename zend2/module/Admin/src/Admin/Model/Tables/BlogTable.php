<?php

namespace Admin\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

class BlogTable {

  protected $tableGateway;
  protected $select;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
    $this->select = new Select();
  }

  public function fetchAll($params = array()) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                "blog_id", "category_id", "author_id",
                "blog_title", "blog_short_desc", "written_date",
                "last_update_date", "is_archive", "is_draft", "is_publish",
                "total_comments" => new Expression("(SELECT COUNT(*) FROM blogs_comments WHERE blog_id  = blogs.blog_id)")
            )
    );
    $select->join("users", "users.user_id = blogs.author_id", array("username"), 'left');
    $select->join("blogs_categories", "blogs_categories.category_id = blogs.category_id", array("category_title"), 'left');

    if ($params['search_field'] && $params['search_key']) {
      $select->where->like("{$params['search_field']}", "%{$params['search_key']}%");
    }

    $select->order("{$params['order_by']} {$params['order']}");

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

}

?>
