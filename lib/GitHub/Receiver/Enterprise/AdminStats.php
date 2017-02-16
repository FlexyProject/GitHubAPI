<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

/**
 * The Admin Stats API provides a variety of metrics about your installation.
 *
 * @link    https://developer.github.com/v3/enterprise/admin_stats/
 * @package GitHub\Receiver\Enterprise
 */
class AdminStats extends AbstractEnterprise
{

    /**
     * Get statistics
     *
     * @link https://developer.github.com/v3/enterprise/admin_stats/#get-statistics
     *
     * @param string $type
     *
     * @return array
     */
    public function getStatistics(string $type): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/enterprise/stats/:type', $type));
    }
} 