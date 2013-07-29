<?php

namespace Admin\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression,
    Zend\Db\Exception;

class PageTable {

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
                "page_id", "page_owner", "page_title",
                "page_description", "page_content", "page_keywords",
                "page_status", "page_date"
            )
    );
    $select->join("users", "users.user_id = core_pages.page_owner", array("username"), 'left');

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

  public function get_page($page_id) {
    $select = $this->tableGateway->getSql()->select();
    $select->where(array('page_id ' => $page_id));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    return $row;
  }

  public function fetchPage($page_id) {
    if (!$page_id || empty($page_id)) {
      return false;
    }
    $select = $this->tableGateway->getSql()->select();
    $select->columns(
            array(
                "page_id", "page_owner", "page_title",
                "page_description", "page_content", "page_keywords",
                "page_status", "page_date"
            )
    );
    $select->join("users", "users.user_id = core_pages.page_owner", array("username"), 'left');


    $select->where(array("page_id" => $page_id));
    $rowset = $this->tableGateway->selectWith($select);
    $row = $rowset->current();
    return $row;
  }

  public function delete_page($page_id) {
    if (!$page_id || empty($page_id)) {
      return false;
    }
    $delete = $this->tableGateway->getSql()->delete();
    $delete->where(array('page_id' => $page_id));

    $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($delete);

    try {
      return $statement->execute();
    } catch (\Exception $e) {
      throw new Exception\RuntimeException($e->getMessage());
    }

    return false;
  }

  public function update_page(array $page_data = array(), $page_id) {
    if (!$page_id || !is_int($page_id)) {
      return false;
    }

    if (!is_array($page_data) || empty($page_data)) {
      return false;
    }

    $update = $this->tableGateway->getSql()->update();
    $page_data['page_update_date'] = new Expression("NOW()");
    $update->set($page_data);
    $update->where(array('page_id' => $page_id));
    $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($update);

    $result = 0;
    try {
      return $statement->execute();        // works fine
    } catch (\Exception $e) {
      throw new Exception\RuntimeException($e->getMessage());
    }

    return $result;
  }

  public function create_page(array $page_data = array()) {
    if (!is_array($page_data) || empty($page_data)) {
      return false;
    }
    # echo "<pre>";
    $page_data['page_date'] = new Expression("NOW()");
    #print_r($page_data);
    $insert = $this->tableGateway->getSql()->insert();
    $insert->values($page_data);
    $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($insert);

    #print_r($statement);
    #exit;
    $result = 0;
    try {
      return $statement->execute();
    } catch (\Exception $e) {
      throw new Exception\RuntimeException($e->getMessage());
    }

    return $result;
  }

}

?>
