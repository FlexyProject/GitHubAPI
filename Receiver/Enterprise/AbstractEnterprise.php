<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

use FlexyProject\GitHub\Receiver\Enterprise;

abstract class AbstractEnterprise {

	/** Properties */
	protected $enterprise;
	protected $api;

	/**
	 * Constructor
	 * @param Enterprise $enterprise
	 */
	public function __construct(Enterprise $enterprise) {
		$this->setEnterprise($enterprise);
		$this->setApi($enterprise->getApi());
	}

	/**
	 * Get enterprise
	 * @return Enterprise
	 */
	public function getEnterprise() {
		return $this->enterprise;
	}

	/**
	 * Set enterprise
	 * @param Enterprise $enterprise
	 * @return AbstractEnterprise
	 */
	public function setEnterprise($enterprise) {
		$this->enterprise = $enterprise;

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
	 * @return AbstractEnterprise
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 