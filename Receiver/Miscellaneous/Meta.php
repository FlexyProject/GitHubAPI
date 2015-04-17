<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

/**
 * The Meta API class provides information about GitHub.com (the service) or your organization’s GitHub Enterprise installation.
 * @link    https://developer.github.com/v3/meta/
 * @package Scion\GitHub\Receiver\Miscellaneous
 */
class Meta extends AbstractMiscellaneous {

	/**
	 * Meta, provides information about GitHub.com, the service.
	 * @link https://developer.github.com/v3/meta/#meta
	 * @return string
	 */
	public function get() {
		return $this->getApi()->request('/meta');
	}
} 