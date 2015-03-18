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
	 * Parse returned data and returns an array
	 * @return array
	 */
	public function parse();
}