<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Enterprise;

/**
 * Class AbstractEnterprise
 *
 * @package FlexyProject\GitHub\Receiver\Enterprise
 */
abstract class AbstractEnterprise
{

    /** Properties */
    protected $enterprise;
    protected $api;

    /**
     * Constructor
     *
     * @param Enterprise $enterprise
     */
    public function __construct(Enterprise $enterprise)
    {
        $this->setEnterprise($enterprise);
        $this->setApi($enterprise->getApi());
    }

    /**
     * Get enterprise
     *
     * @return Enterprise
     */
    public function getEnterprise(): Enterprise
    {
        return $this->enterprise;
    }

    /**
     * Set enterprise
     *
     * @param Enterprise $enterprise
     *
     * @return AbstractEnterprise
     */
    public function setEnterprise(Enterprise $enterprise): AbstractEnterprise
    {
        $this->enterprise = $enterprise;

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
     * @param AbstractApi $api
     *
     * @return AbstractEnterprise
     */
    public function setApi(AbstractApi $api): AbstractEnterprise
    {
        $this->api = $api;

        return $this;
    }
} 