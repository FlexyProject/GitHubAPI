<?php
namespace Scion\GitHub\Receiver\Organizations;

use Scion\GitHub\AbstractApi;
use Scion\GitHub\Receiver\Organizations;

abstract class AbstractOrganizations {

	/** Properties */
	protected $organizations;
	protected $api;

	/**
	 * Constructor
	 * @param Organizations $organizations
	 */
	public function __construct(Organizations $organizations) {
		$this->setOrganizations($organizations);
		$this->setApi($organizations->getApi());
	}

	/**
	 * Get organizations
	 * @return Organizations
	 */
	public function getOrganizations() {
		return $this->organizations;
	}

	/**
	 * Set organizations
	 * @param mixed $organizations
	 * @return AbstractOrganizations
	 */
	public function setOrganizations($organizations) {
		$this->organizations = $organizations;

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
	 * @param mixed $api
	 * @return AbstractOrganizations
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
}