<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

use Scion\GitHub\Receiver\Miscellaneous;

/**
 * The Licenses API class returns information about open source licenses or under what license, if any a given project is distributed.
 * @link    https://developer.github.com/v3/licenses/
 * @package Scion\GitHub\Receiver\Miscellaneous
 */
class Licenses extends AbstractMiscellaneous {

	/**
	 * List all licenses
	 * @link https://developer.github.com/v3/licenses/#list-all-licenses
	 * @return string
	 */
	public function listAllLicenses() {
		$this->getApi()->setAccept('application/vnd.github.drax-preview+json');

		return $this->getApi()->request('/licenses');
	}

	/**
	 * Get an individual license
	 * @link https://developer.github.com/v3/licenses/#get-an-individual-license
	 * @param string $license
	 * @return string
	 */
	public function getIndividualLicense($license) {
		$this->getApi()->setAccept('application/vnd.github.drax-preview+json');

		return $this->getApi()->request($this->getApi()->getString()->sprintf('/licenses/:license', $license));
	}
}