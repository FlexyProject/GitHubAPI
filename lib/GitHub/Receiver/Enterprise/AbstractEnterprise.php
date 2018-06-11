<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Enterprise;

/**
 * Class AbstractEnterprise
 *
 * @package FlexyProject\GitHub\Receiver\Enterprise
 */
abstract class AbstractEnterprise
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $enterprise;

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
}
