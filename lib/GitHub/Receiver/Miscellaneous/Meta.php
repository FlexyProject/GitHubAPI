<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

/**
 * The Meta API class provides information about GitHub.com (the service) or your organization’s GitHub Enterprise
 * installation.
 *
 * @link    https://developer.github.com/v3/meta/
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
class Meta extends AbstractMiscellaneous
{

    /**
     * Meta, provides information about GitHub.com, the service.
     *
     * @link https://developer.github.com/v3/meta/#meta
     * @return array
     */
    public function get(): array
    {
        return $this->getApi()->request('/meta');
    }
} 