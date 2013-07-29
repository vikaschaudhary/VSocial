<?php
namespace VSocial\Google\Api\Plus\Person;

use VSocial\Google\Service\Model;
class Organizations
        extends Model {

    public $department;
    public $description;
    public $endDate;
    public $location;
    public $name;
    public $primary;
    public $startDate;
    public $title;
    public $type;

    public function setDepartment ($department) {
        $this->department = $department;
    }

    public function getDepartment () {
        return $this->department;
    }

    public function setDescription ($description) {
        $this->description = $description;
    }

    public function getDescription () {
        return $this->description;
    }

    public function setEndDate ($endDate) {
        $this->endDate = $endDate;
    }

    public function getEndDate () {
        return $this->endDate;
    }

    public function setLocation ($location) {
        $this->location = $location;
    }

    public function getLocation () {
        return $this->location;
    }

    public function setName ($name) {
        $this->name = $name;
    }

    public function getName () {
        return $this->name;
    }

    public function setPrimary ($primary) {
        $this->primary = $primary;
    }

    public function getPrimary () {
        return $this->primary;
    }

    public function setStartDate ($startDate) {
        $this->startDate = $startDate;
    }

    public function getStartDate () {
        return $this->startDate;
    }

    public function setTitle ($title) {
        $this->title = $title;
    }

    public function getTitle () {
        return $this->title;
    }

    public function setType ($type) {
        $this->type = $type;
    }

    public function getType () {
        return $this->type;
    }

}

?>
