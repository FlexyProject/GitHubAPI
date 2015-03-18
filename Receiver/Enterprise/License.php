<?php
namespace Scion\GitHub\Receiver\Enterprise;

/**
 * Class License
 * @see     https://developer.github.com/v3/enterprise/license/
 * @package GitHub\Receiver\Enterprise
 */
class License extends AbstractEnterprise {

	/**
	 * Get license information
	 * @see https://developer.github.com/v3/enterprise/license/#get-license-information
	 * @return mixed
	 */
	public function getLicenseInformation() {
		return $this->getApi()->request(
			sprintf('/enterprise/settings/license')
		);
	}
} 