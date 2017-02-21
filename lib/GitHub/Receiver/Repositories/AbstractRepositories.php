<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Repositories;

/**
 * Class AbstractRepositories
 *
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
abstract class AbstractRepositories
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $repositories;

    /**
     * Constructor
     *
     * @param Repositories $repositories
     */
    public function __construct(Repositories $repositories)
    {
        $this->setRepositories($repositories);
        $this->setApi($repositories->getApi());
    }

    /**
     * Get repositories
     *
     * @return Repositories
     */
    public function getRepositories(): Repositories
    {
        return $this->repositories;
    }

    /**
     * Set repositories
     *
     * @param Repositories $repositories
     *
     * @return AbstractRepositories
     */
    public function setRepositories(Repositories $repositories): AbstractRepositories
    {
        $this->repositories = $repositories;

        return $this;
    }
}