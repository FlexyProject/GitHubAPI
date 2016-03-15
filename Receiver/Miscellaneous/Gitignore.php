<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

/**
 * The Gitignore API class gives you access to the available gitignore templates.
 * @link    https://developer.github.com/v3/gitignore/
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
class Gitignore extends AbstractMiscellaneous {

	/**
	 * Listing available templates
	 * @link https://developer.github.com/v3/gitignore/#listing-available-templates
	 * @return array
	 */
	public function listingAvailableTemplates() {
		return $this->getApi()->request('/gitignore/templates');
	}

	/**
	 * Get a single template
	 * @link https://developer.github.com/v3/gitignore/#get-a-single-template
	 * @param string $name
	 * @return array
	 */
	public function getSingleTemplate($name) {
		return $this->getApi()->request($this->getApi()->sprintf('/gitignore/templates/:name', $name));
	}
} 