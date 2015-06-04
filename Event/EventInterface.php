<?php
namespace Scion\GitHub\Event;

use Scion\GitHub\WebHook;

interface EventInterface {

	/**
	 * Constructor, pass a WebHook object
	 * @param WebHook $webHook
	 */
	public function __construct(WebHook $webHook);

	/**
	 * Parse raw data
	 * @return Payload
	 */
	public function parse();
}