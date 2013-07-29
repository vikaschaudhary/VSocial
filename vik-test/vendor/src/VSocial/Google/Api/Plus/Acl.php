<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class Acl
        extends Model {

    public $description;
    protected $__itemsType = '\\VSocial\\Google\\Api\\Plus\\AclentryResource';
    protected $__itemsDataType = 'array';
    public $items;
    public $kind;

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setItems (/* array(Google_PlusAclentryResource) */ $items) {
        $this->assertIsArray($items, '\\VSocial\\Google\\Api\\Plus\\AclentryResource', __METHOD__);
        $this->items = $items;
    }

    public function getItems () {
        return $this->items;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

}

?>
