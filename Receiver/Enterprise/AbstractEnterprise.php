<?php
namespace Scion\Services\GitHub\Receiver\Enterprise;

use Scion\Services\GitHub\Receiver\Enterprise;

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