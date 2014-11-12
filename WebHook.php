<?php
namespace Scion\Services\GitHub;

class WebHook extends AbstractApi {

	/** Constants */
	const PAYLOAD = 'Payload';

	/**
	 * Returns Event object
	 * @param string $event
	 * @return mixed
	 */
	public function getEvent($event) {
		$class = __NAMESPACE__ . '\Event\\' . $event;

		return new $class($this);
	}
} 