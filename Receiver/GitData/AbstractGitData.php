<?php
namespace Scion\GitHub\Receiver\GitData;

use Scion\GitHub\Receiver\GitData;

abstract class AbstractGitData {

	/** Properties */
	protected $gitData;
	protected $api;

	/**
	 * Constructor
	 * @param GitData $gitData
	 */
	public function __construct(GitData $gitData) {
		$this->setGitData($gitData);
		$this->setApi($gitData->getApi());
	}

	/**
	 * Get gitData
	 * @return GitData
	 */
	public function getGitData() {
		return $this->gitData;
	}

	/**
	 * Set gitData
	 * @param GitData $gitData
	 * @return AbstractGitData
	 */
	public function setGitData($gitData) {
		$this->gitData = $gitData;

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
	 * @return AbstractGitData
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 