<?php
namespace Scion\GitHub\Receiver\PullRequests;

use Scion\GitHub\Receiver\PullRequests;

abstract class AbstractPullRequests {

	/** Properties */
	protected $pullRequests;
	protected $api;

	/**
	 * Constructor
	 * @param PullRequests $pullRequests
	 */
	public function __construct(PullRequests $pullRequests) {
		$this->setPullRequests($pullRequests);
		$this->setApi($pullRequests->getApi());
	}

	/**
	 * Get pullRequests
	 * @return PullRequests
	 */
	public function getPullRequests() {
		return $this->pullRequests;
	}

	/**
	 * Set pullRequests
	 * @param PullRequests $pullRequests
	 * @return AbstractPullRequests
	 */
	public function setPullRequests($pullRequests) {
		$this->pullRequests = $pullRequests;

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
	 * @return AbstractPullRequests
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 