<?php

namespace Blog\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression;

class CategoryTable extends TableGateway {

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
                'category_id', 'category_title', 'status',
            )
    );
    $select->order('category_title');

    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

  public function fetch_all_with_count() {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                'category_id', 'category_title', 'status',
                'count' => new Expression("(SELECT COUNT(*) FROM blogs WHERE blogs.category_id = blogs_categories.category_id)")
            )
    );
    $select->order('category_title');

    $resultSet = $this->tableGateway->selectWith($select);
    $resultSet->buffer();

    if ($resultSet) {
      return $resultSet;
    }
    return false;
  }

  public function getCategory($id) {
    $id = (int) $id;
    $rowset = $this->tableGateway->select(array('category_id' => $id));
    $row = $rowset->current();
    if (!$row) {
      throw new \Exception("Could not find row $id");
    }
    return $row;
  }

}

?>
