<?php
namespace FlexyProject\GitHub;

use FlexyProject\GitHub\Event\EventInterface;

/**
 * Webhooks allow you to build or set up integrations which subscribe to certain events on GitHub.com.
 *
 * @link    https://developer.github.com/webhooks/
 * @package FlexyProject\GitHub
 */
class WebHook extends AbstractApi
{

    /** Constants */
    const PAYLOAD = 'Payload';

    /**
     * Returns Event object
     *
     * @param string $event
     *
     * @return null|EventInterface
     */
    public function getEvent(string $event)
    {
        $class = (string)$this->sprintf(':namespace\Event\:event', __NAMESPACE__, $event);

        if (class_exists($class)) {
            return new $class($this);
        }

        return null;
    }
}
