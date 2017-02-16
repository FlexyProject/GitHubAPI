<?php
namespace FlexyProject\GitHub\Receiver\Organizations;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Organizations;

/**
 * Class AbstractOrganizations
 *
 * @package FlexyProject\GitHub\Receiver\Organizations
 */
abstract class AbstractOrganizations
{

    /** Properties */
    protected $organizations;
    protected $api;

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

    /**
     * Get api
     *
     * @return AbstractApi
     */
    public function getApi(): AbstractApi
    {
        return $this->api;
    }

    /**
     * Set api
     *
     * @param mixed $api
     *
     * @return AbstractOrganizations
     */
    public function setApi(AbstractApi $api): AbstractOrganizations
    {
        $this->api = $api;

        return $this;
    }
}