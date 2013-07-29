<?php
namespace VSocial\Google\Api\Plus;

use VSocial\Google\Service\Model;

class Moment
        extends Model {

    public $id;
    public $kind;
    protected $__resultType = 'Google_ItemScope';
    protected $__resultDataType = '';
    public $result;
    public $startDate;
    protected $__targetType = 'Google_ItemScope';
    protected $__targetDataType = '';
    public $target;
    public $type;

    public function setId ($id) {
        $this->id = $id;
    }

    public function getId () {
        return $this->id;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setResult (Google_ItemScope $result) {
        $this->result = $result;
    }

    public function getResult () {
        return $this->result;
    }

    public function setStartDate ($startDate) {
        $this->startDate = $startDate;
    }

    public function getStartDate () {
        return $this->startDate;
    }

    public function setTarget (Google_ItemScope $target) {
        $this->target = $target;
    }

    public function getTarget () {
        return $this->target;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

}

?>
