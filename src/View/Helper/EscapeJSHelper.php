<?php
namespace App\View\Helper;
use Cake\View\Helper;
class EscapeJSHelper extends Helper {
	/**
	 * Escapes a PHP variable (Array/String/Number/Boolean/null) to a JavaScript safe value.
	 * This will be safe from XSS in JavaScript context, but not necessarily HTML.
	 * Use jQuery .text() instead of .html() when adding to HTML; .val() and .prop() are safe
	 *
	 * @link https://en.wikibooks.org/wiki/Web_Application_Security_Guide/Cross-site_scripting_(XSS)
	 * @param string $var
	 * @return string
	 */
	public function phpToJs($var) {
		$jsonString = json_encode($var, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS);
		if ($jsonString !== false) {
			return $jsonString;
		}
		return 'null';
	}
}
