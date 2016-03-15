<?php
namespace FlexyProject\GitHub\Receiver\Gists;

use FlexyProject\GitHub\Receiver\Gists;

abstract class AbstractGists {

	/** Properties */
	protected $gists;
	protected $api;

	/**
	 * Constructor
	 * @param Gists $gists
	 */
	public function __construct(Gists $gists) {
		$this->setGists($gists);
		$this->setApi($gists->getApi());
	}

	/**
	 * Get gists
	 * @return Gists
	 */
	public function getGists() {
		return $this->gists;
	}

	/**
	 * Set gists
	 * @param Gists $gists
	 * @return AbstractGists
	 */
	public function setGists($gists) {
		$this->gists = $gists;

		return $this;
	}

	/**
	 * Get api
	 * @return \FlexyProject\GitHub\AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param \FlexyProject\GitHub\AbstractApi $api
	 * @return AbstractGists
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
}