<?php
namespace VSocial\Google\Api\Plus\Person\Cover;

use VSocial\Google\Service\Model;

class Info
        extends Model {

    public $leftImageOffset;
    public $topImageOffset;

    public function setLeftImageOffset ($leftImageOffset) {
        $this->leftImageOffset = $leftImageOffset;
    }

    public function getLeftImageOffset () {
        return $this->leftImageOffset;
    }

    public function setTopImageOffset ($topImageOffset) {
        $this->topImageOffset = $topImageOffset;
    }

    public function getTopImageOffset () {
        return $this->topImageOffset;
    }

}

?>
