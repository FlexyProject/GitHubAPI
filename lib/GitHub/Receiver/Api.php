<?php
namespace FlexyProject\GitHub\Receiver;

/**
 * Class Api
 *
 * @package FlexyProject\GitHub\Receiver
 */
trait Api
{
    /** @var  mixed */
    protected $api;

    /**
     * Get api
     *
     * @return mixed
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set api
     *
     * @param mixed $api
     *
     * @return $this
     */
    public function setApi($api)
    {
        $this->api = $api;

        return $this;
    }
}