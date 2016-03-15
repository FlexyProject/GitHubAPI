<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Miscellaneous;

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
	public function getMiscellaneous(): Miscellaneous {
		return $this->miscellaneous;
	}

	/**
	 * Set miscellaneous
	 * @param Miscellaneous $miscellaneous
	 * @return AbstractMiscellaneous
	 */
	public function setMiscellaneous(Miscellaneous $miscellaneous): AbstractMiscellaneous {
		$this->miscellaneous = $miscellaneous;

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
	 * @return AbstractMiscellaneous
	 */
	public function setApi(AbstractApi $api): AbstractMiscellaneous {
		$this->api = $api;

		return $this;
	}
} 