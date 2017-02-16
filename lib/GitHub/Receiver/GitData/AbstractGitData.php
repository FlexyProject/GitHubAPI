<?php
namespace FlexyProject\GitHub\Receiver\GitData;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\GitData;

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
	public function getGitData(): GitData {
		return $this->gitData;
	}

	/**
	 * Set gitData
	 * @param GitData $gitData
	 * @return AbstractGitData
	 */
	public function setGitData(GitData $gitData): AbstractGitData {
		$this->gitData = $gitData;

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
	 * @return AbstractGitData
	 */
	public function setApi(AbstractApi $api): AbstractGitData {
		$this->api = $api;

		return $this;
	}
} 