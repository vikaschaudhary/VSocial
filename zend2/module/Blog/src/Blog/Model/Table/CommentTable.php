<?php

namespace Blog\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

class CommentTable extends TableGateway {

  protected $tableGateway;
  protected $select;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
    $this->select = new Select();
  }

  public function fetch_all($blog_id, $limit = 10) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'comment_id', 'blog_id', 'user_id', 'comment_text', 'comment_date', 'status',
            )
    );
    $select->join('users', 'users.user_id = blogs_comments.user_id', array('username'), 'left');
    $select->order('comment_date DESC');
    $select->where(array("blog_id" => (int) $blog_id));
    $select->limit($limit);
    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

}

?>
