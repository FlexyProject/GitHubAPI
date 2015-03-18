<?php
namespace Scion\GitHub\Receiver\Issues;

use Scion\GitHub\Receiver\Issues;

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
	 * @return \Scion\GitHub\AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param \Scion\GitHub\AbstractApi $api
	 * @return AbstractIssues
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 