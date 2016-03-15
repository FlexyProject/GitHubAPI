<?php
namespace FlexyProject\GitHub\Receiver\PullRequests;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\PullRequests;

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
	public function getPullRequests(): PullRequests {
		return $this->pullRequests;
	}

	/**
	 * Set pullRequests
	 * @param PullRequests $pullRequests
	 * @return AbstractPullRequests
	 */
	public function setPullRequests(PullRequests $pullRequests): AbstractPullRequests {
		$this->pullRequests = $pullRequests;

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
	 * @return AbstractPullRequests
	 */
	public function setApi(AbstractApi $api): AbstractPullRequests {
		$this->api = $api;

		return $this;
	}
} 