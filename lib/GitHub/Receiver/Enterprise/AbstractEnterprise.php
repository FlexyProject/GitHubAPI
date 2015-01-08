<?php
namespace GitHub\Receiver\Enterprise;

use GitHub\Receiver\Enterprise;

abstract class AbstractEnterprise {

	protected $activity;
	protected $api;

	/**
	 * Constructor
	 * @param Enterprise $enterprise
	 */
	public function __construct(Enterprise $enterprise) {
		$this->enterprise = $enterprise;
		$this->api        = $enterprise->getApi();
	}
} 