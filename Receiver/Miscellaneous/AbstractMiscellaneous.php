<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

use Scion\GitHub\Receiver\Miscellaneous;

abstract class AbstractMiscellaneous {

	/** Properties */
	protected $miscellaneous;
	protected $api;

	/**
	 * Constructor
	 * @param Miscellaneous $miscellaneous
	 */
	public function __construct(Miscellaneous $miscellaneous) {
		$this->setMiscellaneous($miscellaneous);
		$this->setApi($miscellaneous->getApi());
	}

	/**
	 * Get miscellaneous
	 * @return Miscellaneous
	 */
	public function getMiscellaneous() {
		return $this->miscellaneous;
	}

	/**
	 * Set miscellaneous
	 * @param Miscellaneous $miscellaneous
	 * @return AbstractMiscellaneous
	 */
	public function setMiscellaneous($miscellaneous) {
		$this->miscellaneous = $miscellaneous;

		return $this;
	}

	/**
	 * Get api
	 * @return \Scion\GitHub\AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param \Scion\GitHub\AbstractApi $api
	 * @return AbstractMiscellaneous
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 