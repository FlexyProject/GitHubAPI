<?php
namespace Scion\GitHub;

use Scion\GitHub\Event\EventInterface;

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