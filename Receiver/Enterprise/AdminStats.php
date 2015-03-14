<?php
namespace Scion\GitHub\Receiver\Enterprise;

/**
 * Class AdminStats
 * @see     https://developer.github.com/v3/enterprise/admin_stats/
 * @package GitHub\Receiver\Enterprise
 */
class AdminStats extends AbstractEnterprise {

	/**
	 * Get statistics
	 * @see https://developer.github.com/v3/enterprise/admin_stats/#get-statistics
	 * @param string $type
	 * @return mixed
	 */
	public function getStatistics($type) {
		return $this->api->request(
			sprintf('/enterprise/stats/%s', $type)
		);
	}
} 