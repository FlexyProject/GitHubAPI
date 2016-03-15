<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Repositories;

abstract class AbstractRepositories {

	/** Properties */
	protected $repositories;
	protected $api;

	/**
	 * Constructor
	 * @param Repositories $repositories
	 */
	public function __construct(Repositories $repositories) {
		$this->setRepositories($repositories);
		$this->setApi($repositories->getApi());
	}

	/**
	 * Get repositories
	 * @return Repositories
	 */
	public function getRepositories(): Repositories {
		return $this->repositories;
	}

	/**
	 * Set repositories
	 * @param Repositories $repositories
	 * @return AbstractRepositories
	 */
	public function setRepositories(Repositories $repositories): AbstractRepositories {
		$this->repositories = $repositories;

		return $this;
	}

	/**
	 * Get api
	 * @return AbstractApi
	 */
	public function getApi(): AbstractApi {
		return $this->api;
	}

	/**
	 * Set api
	 * @param AbstractApi $api
	 * @return AbstractRepositories
	 */
	public function setApi(AbstractApi $api): AbstractRepositories {
		$this->api = $api;

		return $this;
	}
} 