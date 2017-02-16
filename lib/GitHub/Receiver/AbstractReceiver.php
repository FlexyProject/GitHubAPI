<?php
namespace FlexyProject\GitHub\Receiver;

use FlexyProject\GitHub\AbstractApi;

/**
 * Class AbstractReceiver
 *
 * @package FlexyProject\GitHub\Receiver
 */
abstract class AbstractReceiver
{

    /** Protected properties */
    protected $api;
    protected $owner = '';
    protected $repo  = '';

    /**
     * Constructor
     *
     * @param AbstractApi $api
     */
    public function __construct(AbstractApi $api)
    {
        $this->setApi($api);
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
     * @return AbstractReceiver
     */
    public function setApi(AbstractApi $api): AbstractReceiver
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return AbstractReceiver
     */
    public function setOwner(string $owner): AbstractReceiver
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get repository
     *
     * @return string
     */
    public function getRepo(): string
    {
        return $this->repo;
    }

    /**
     * Set repository
     *
     * @param string $repo
     *
     * @return AbstractReceiver
     */
    public function setRepo(string $repo): AbstractReceiver
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Get a sub-receiver
     *
     * @param string $name
     *
     * @return null|object
     */
    public function getReceiver(string $name)
    {
        $classPath = explode('\\', get_called_class());
        $class     = (string)$this->getApi()
                                  ->sprintf(':namespace\:class\:method', __NAMESPACE__, end($classPath), $name);

        if (class_exists($class)) {
            return new $class($this);
        }

        return null;
    }
} 