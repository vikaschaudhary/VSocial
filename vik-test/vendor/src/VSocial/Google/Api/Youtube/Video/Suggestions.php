<?php
namespace VSocial\Google\Api\Youtube\Video;

use VSocial\Google\Service\Model;

class Suggestions
        extends Model {

    public $editorSuggestions;
    public $processingErrors;
    public $processingHints;
    public $processingWarnings;
    protected $__tagSuggestionsType = 'Google_VideoSuggestionsTagSuggestion';
    protected $__tagSuggestionsDataType = 'array';
    public $tagSuggestions;

    public function setEditorSuggestions (/* array(Google_string) */ $editorSuggestions) {
        $this->assertIsArray($editorSuggestions, 'Google_string', __METHOD__);
        $this->editorSuggestions = $editorSuggestions;
    }

    public function getEditorSuggestions () {
        return $this->editorSuggestions;
    }

    public function setProcessingErrors (/* array(Google_string) */ $processingErrors) {
        $this->assertIsArray($processingErrors, 'Google_string', __METHOD__);
        $this->processingErrors = $processingErrors;
    }

    public function getProcessingErrors () {
        return $this->processingErrors;
    }

    public function setProcessingHints (/* array(Google_string) */ $processingHints) {
        $this->assertIsArray($processingHints, 'Google_string', __METHOD__);
        $this->processingHints = $processingHints;
    }

    public function getProcessingHints () {
        return $this->processingHints;
    }

    public function setProcessingWarnings (/* array(Google_string) */ $processingWarnings) {
        $this->assertIsArray($processingWarnings, 'Google_string', __METHOD__);
        $this->processingWarnings = $processingWarnings;
    }

    public function getProcessingWarnings () {
        return $this->processingWarnings;
    }

    public function setTagSuggestions (/* array(Google_VideoSuggestionsTagSuggestion) */ $tagSuggestions) {
        $this->assertIsArray($tagSuggestions, 'Google_VideoSuggestionsTagSuggestion', __METHOD__);
        $this->tagSuggestions = $tagSuggestions;
    }

    public function getTagSuggestions () {
        return $this->tagSuggestions;
    }

}

?>