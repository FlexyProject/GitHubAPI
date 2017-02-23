<?php
namespace FlexyProject\GitHub\Receiver\Gists;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Gists;

/**
 * Class AbstractGists
 *
 * @package FlexyProject\GitHub\Receiver\Gists
 */
abstract class AbstractGists
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $gists;

    /**
     * Constructor
     *
     * @param Gists $gists
     */
    public function __construct(Gists $gists)
    {
        $this->setGists($gists);
        $this->setApi($gists->getApi());
    }

    /**
     * Get gists
     *
     * @return Gists
     */
    public function getGists(): Gists
    {
        return $this->gists;
    }

    /**
     * Set gists
     *
     * @param Gists $gists
     *
     * @return AbstractGists
     */
    public function setGists(Gists $gists): AbstractGists
    {
        $this->gists = $gists;

        return $this;
    }
}