<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

class Gitignore extends AbstractMiscellaneous {

	/**
	 * Listing available templates
	 * @see https://developer.github.com/v3/gitignore/#listing-available-templates
	 * @return string
	 */
	public function listingAvailableTemplates() {
		return $this->getApi()->request('/gitignore/templates');
	}

	/**
	 * Get a single template
	 * @param string $name
	 * @return string
	 */
	public function getSingleTemplate($name) {
		return $this->getApi()->request(sprintf('/gitignore/templates/%s', $name));
	}
} 