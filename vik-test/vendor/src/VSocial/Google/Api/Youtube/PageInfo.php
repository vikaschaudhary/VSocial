<?php
namespace VSocial\Google\Api\Youtube;

use VSocial\Google\Service\Model;

class PageInfo
        extends Model {

    public $resultsPerPage;
    public $totalResults;

    public function setResultsPerPage ($resultsPerPage) {
        $this->resultsPerPage = $resultsPerPage;
    }

    public function getResultsPerPage () {
        return $this->resultsPerPage;
    }

    public function setTotalResults ($totalResults) {
        $this->totalResults = $totalResults;
    }

    public function getTotalResults () {
        return $this->totalResults;
    }

}

?>
