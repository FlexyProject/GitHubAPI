<?php
namespace FlexyProject\GitHub\Receiver\Gists;

use FlexyProject\GitHub\AbstractApi;
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
	public function getGists(): Gists {
		return $this->gists;
	}

	/**
	 * Set gists
	 * @param Gists $gists
	 * @return AbstractGists
	 */
	public function setGists(Gists $gists): AbstractGists {
		$this->gists = $gists;

		return $this;
	}

	/**
	 * Get api
	 * @return AbstractApi
	 */
	public function getApi(): AbstractApi{
		return $this->api;
	}

	/**
	 * Set api
	 * @param AbstractApi $api
	 * @return AbstractGists
	 */
	public function setApi(AbstractApi $api): AbstractGists {
		$this->api = $api;

		return $this;
	}
}