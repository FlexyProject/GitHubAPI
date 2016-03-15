<?php
namespace FlexyProject\GitHub\Receiver\Issues;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Issues;

abstract class AbstractIssues {

	protected $issues;
	protected $api;

	/**
	 * Constructor
	 * @param Issues $issues
	 */
	public function __construct(Issues $issues) {
		$this->setIssues($issues);
		$this->setApi($issues->getApi());
	}

	/**
	 * Get issues
	 * @return Issues
	 */
	public function getIssues(): Issues {
		return $this->issues;
	}

	/**
	 * Set issues
	 * @param Issues $issues
	 * @return AbstractIssues
	 */
	public function setIssues(Issues $issues): AbstractIssues {
		$this->issues = $issues;

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
	 * @return AbstractIssues
	 */
	public function setApi(AbstractApi $api): AbstractIssues {
		$this->api = $api;

		return $this;
	}
} 