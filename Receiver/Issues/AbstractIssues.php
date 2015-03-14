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
		$this->issues = $issues;
		$this->api    = $issues->getApi();
	}
} 