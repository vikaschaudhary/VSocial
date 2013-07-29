<?php

namespace NIC\Db\Adapter;

interface AdapterInterface {

  /**
   * @return Zend\Db\Adapter
   */
  public function getSlaveAdapter();
}
