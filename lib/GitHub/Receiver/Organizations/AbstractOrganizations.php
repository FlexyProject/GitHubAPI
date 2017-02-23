<?php
namespace FlexyProject\GitHub\Receiver\Organizations;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Organizations;

/**
 * Class AbstractOrganizations
 *
 * @package FlexyProject\GitHub\Receiver\Organizations
 */
abstract class AbstractOrganizations
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $organizations;

    /**
     * Constructor
     *
     * @param Organizations $organizations
     */
    public function __construct(Organizations $organizations)
    {
        $this->setOrganizations($organizations);
        $this->setApi($organizations->getApi());
    }

    /**
     * Get organizations
     *
     * @return Organizations
     */
    public function getOrganizations(): Organizations
    {
        return $this->organizations;
    }

    /**
     * Set organizations
     *
     * @param Organizations $organizations
     *
     * @return AbstractOrganizations
     */
    public function setOrganizations(Organizations $organizations): AbstractOrganizations
    {
        $this->organizations = $organizations;

        return $this;
    }
}