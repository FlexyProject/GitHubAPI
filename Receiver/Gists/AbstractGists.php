<?php
namespace Scion\GitHub\Receiver\Gists;

use Scion\GitHub\Receiver\Gists;

abstract class AbstractGists {

	protected $gists;
	protected $api;

	/**
	 * Constructor
	 * @param Gists $gists
	 */
	public function __construct(Gists $gists) {
		$this->gists = $gists;
		$this->api   = $gists->getApi();
	}
}