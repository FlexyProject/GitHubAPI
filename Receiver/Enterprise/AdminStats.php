<?php
namespace Scion\GitHub\Receiver\Enterprise;

/**
 * The Admin Stats API provides a variety of metrics about your installation.
 * @link    https://developer.github.com/v3/enterprise/admin_stats/
 * @package GitHub\Receiver\Enterprise
 */
class AdminStats extends AbstractEnterprise {

	/**
	 * Get statistics
	 * @link https://developer.github.com/v3/enterprise/admin_stats/#get-statistics
	 * @param string $type
	 * @return mixed
	 */
	public function getStatistics($type) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/enterprise/stats/:type', $type)
		);
	}
} 