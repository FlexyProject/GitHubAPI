<?php
namespace FlexyProject\GitHub\Receiver\Issues;

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
	public function getIssues() {
		return $this->issues;
	}

	/**
	 * Set issues
	 * @param Issues $issues
	 * @return AbstractIssues
	 */
	public function setIssues($issues) {
		$this->issues = $issues;

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
	 * @return AbstractIssues
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 