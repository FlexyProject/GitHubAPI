<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

/**
 * The License API provides information on your Enterprise license.
 *
 * @link    https://developer.github.com/v3/enterprise/license/
 * @package GitHub\Receiver\Enterprise
 */
class License extends AbstractEnterprise
{

    /**
     * Get license information
     *
     * @link https://developer.github.com/v3/enterprise/license/#get-license-information
     * @return array
     */
    public function getLicenseInformation(): array
    {
        return $this->getApi()->request(sprintf('/enterprise/settings/license'));
    }
} 