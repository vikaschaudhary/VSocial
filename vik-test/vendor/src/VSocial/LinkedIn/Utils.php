<?php
namespace VSocial\LinkedIn;

use VSocial\LinkedIn\LinkedInException;

class Utils {

    /**
     * LinkedIn ID validation.
     * 	 
     * Checks the passed string $id to see if it has a valid LinkedIn ID format, 
     * which is, as of October 15th, 2010:
     * 
     *   10 alpha-numeric mixed-case characters, plus underscores and dashes.          	 
     * 
     * @param str $id 
     *    A possible LinkedIn ID.         	 
     * 
     * @return bool 
     *    TRUE/FALSE depending on valid ID format determination.                  
     */
    public static function isId ($id) {
        // check passed data
        if (!is_string($id)) {
            // bad data passed
            throw new LinkedInException('LinkedIn->isId(): bad data passed, $id must be of type string.');
        }

        $pattern = '/^[a-z0-9_\-]{10}$/i';
        if ($match = preg_match($pattern, $id)) {
            // we have a match
            $return_data = TRUE;
        } else {
            // no match
            $return_data = FALSE;
        }
        return $return_data;
    }

    /**
     * Throttling check.
     * 
     * Checks the passed LinkedIn response to see if we have hit a throttling 
     * limit:
     * 
     * http://developer.linkedin.com/docs/DOC-1112
     * 
     * @param arr $response 
     *    The LinkedIn response.
     *                     	 
     * @return bool
     *    TRUE/FALSE depending on content of response.                  
     */
    public static function isThrottled ($response) {
        $return_data = FALSE;

        // check the variable
        if (!empty($response) && is_string($response)) {
            // we have an array and have a properly formatted LinkedIn response
            // store the response in a temp variable
            $temp_response = self::xmlToArray($response);
            if ($temp_response !== FALSE) {
                // check to see if we have an error
                if (array_key_exists('error', $temp_response) && ($temp_response['error']['children']['status']['content'] == 403) && preg_match('/throttle/i', $temp_response['error']['children']['message']['content'])) {
                    // we have an error, it is 403 and we have hit a throttle limit
                    $return_data = TRUE;
                }
            }
        }
        return $return_data;
    }

    /**
     * Converts passed XML data to an array.
     * 
     * @param str $xml 
     *    The XML to convert to an array.
     *            	 
     * @return arr 
     *    Array containing the XML data.     
     * @return bool 
     *    FALSE if passed data cannot be parsed to an array.     	 
     */
    public static function xmlToArray ($xml) {
        // check passed data
        if (!is_string($xml)) {
            // bad data possed
            throw new LinkedInException('LinkedIn->xmlToArray(): bad data passed, $xml must be a non-zero length string.');
        }

        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        if (xml_parse_into_struct($parser, $xml, $tags)) {
            $elements = array();
            $stack = array();
            foreach ($tags as $tag) {
                $index = count($elements);
                if ($tag['type'] == 'complete' || $tag['type'] == 'open') {
                    $elements[$tag['tag']] = array();
                    $elements[$tag['tag']]['attributes'] = (array_key_exists('attributes', $tag)) ? $tag['attributes'] : NULL;
                    $elements[$tag['tag']]['content'] = (array_key_exists('value', $tag)) ? $tag['value'] : NULL;
                    if ($tag['type'] == 'open') {
                        $elements[$tag['tag']]['children'] = array();
                        $stack[count($stack)] = &$elements;
                        $elements = &$elements[$tag['tag']]['children'];
                    }
                }
                if ($tag['type'] == 'close') {
                    $elements = &$stack[count($stack) - 1];
                    unset($stack[count($stack) - 1]);
                }
            }
            $return_data = $elements;
        } else {
            // not valid xml data
            $return_data = FALSE;
        }
        xml_parser_free($parser);
        return $return_data;
    }

}

?>
