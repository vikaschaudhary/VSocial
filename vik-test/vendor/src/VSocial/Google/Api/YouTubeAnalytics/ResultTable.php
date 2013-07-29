<?php
namespace VSocial\Google\Api\YouTubeAnalytics;

use VSocial\Google\Service\Model;

class ResultTable
        extends Model {

    protected $__columnHeadersType = '\\VSocial\\Google\\Api\\YouTubeAnalytics\\ResultTableColumnHeaders';
    protected $__columnHeadersDataType = 'array';
    public $columnHeaders;
    public $kind;
    public $rows;

    public function setColumnHeaders (/* array(Google_ResultTableColumnHeaders) */ $columnHeaders) {
        $this->assertIsArray($columnHeaders, '\\VSocial\\Google\\Api\\YouTubeAnalytics\\ResultTableColumnHeaders', __METHOD__);
        $this->columnHeaders = $columnHeaders;
    }

    public function getColumnHeaders () {
        return $this->columnHeaders;
    }

    public function setKind ($kind) {
        $this->kind = $kind;
    }

    public function getKind () {
        return $this->kind;
    }

    public function setRows (/* array(Google_object) */ $rows) {
        $this->assertIsArray($rows, 'Google_object', __METHOD__);
        $this->rows = $rows;
    }

    public function getRows () {
        return $this->rows;
    }

}

?>
