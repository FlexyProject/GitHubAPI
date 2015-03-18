<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\AbstractApi;
use Scion\GitHub\Receiver\Repositories;

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
	 * @return mixed
	 */
	public function getRepositories() {
		return $this->repositories;
	}

	/**
	 * Set repositories
	 * @param mixed $repositories
	 * @return $this
	 */
	public function setRepositories($repositories) {
		$this->repositories = $repositories;

		return $this;
	}

	/**
	 * Get api
	 * @return AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param AbstractApi $api
	 * @return $this
	 */
	public function setApi(AbstractApi $api) {
		$this->api = $api;

		return $this;
	}
} 