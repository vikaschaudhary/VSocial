<?php

namespace Admin\Model\Table;

use Zend\Db\TableGateway\TableGateway,
    Zend\Db\Sql\Select,
    Zend\Db\Sql\Expression,
    Zend\Db\Exception;

class SettingTable {

  protected $tableGateway;
  protected $select;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
    $this->select = new Select();
  }

  public function fetchAll($params = array()) {
    $select = $this->tableGateway->getSql()->select();
    $select->columns(array("setting_id", "name", "value"));


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

  public function get_value($id) {
    if (!$id || empty($id) || !is_int($id)) {
      return false;
    }

    $select = $this->tableGateway->getSql()->select();
    $select->columns(array("setting_id", "name", "value"));

    $select->where(array("setting_id" => $id));

    $rowset = $this->tableGateway->selectWith($select);
    return $rowset->current();
  }

  public function update_value(array $data = array(), $id) {
    if (!$id || empty($id) || !is_int($id)) {
      return false;
    }

    if (!is_array($data) || empty($data)) {
      return false;
    }

    $update = $this->tableGateway->getSql()->update();
    $update->set($data);
    $update->where(array('setting_id' => $id));
    $statement = $this->tableGateway->getSql()->prepareStatementForSqlObject($update);

    try {
      return $statement->execute();        // works fine
    } catch (\Exception $e) {
      throw new Exception\RuntimeException($e->getMessage());
    }

    return false;
  }

}

?>
