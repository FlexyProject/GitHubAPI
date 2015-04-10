<?php
namespace Scion\GitHub;

use Scion\GitHub\Event\EventInterface;

/**
 * Webhooks allow you to build or set up integrations which subscribe to certain events on GitHub.com.
 * Complete documentation is available at https://developer.github.com/webhooks/.
 * @package Scion\GitHub
 */
class WebHook extends AbstractApi {

	/** Constants */
	const PAYLOAD = 'Payload';

	/**
	 * Returns Event object
	 * @param string $event
	 * @return EventInterface
	 */
	public function getEvent($event) {
		$class = sprintf('%s\Event\%s', __NAMESPACE__, $event);

		return new $class($this);
	}
} 