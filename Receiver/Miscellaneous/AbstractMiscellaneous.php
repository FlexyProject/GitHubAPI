<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

use Scion\GitHub\Receiver\Miscellaneous;

abstract class AbstractMiscellaneous {

	protected $miscellaneous;
	protected $api;

	/**
	 * Constructor
	 * @param Miscellaneous $miscellaneous
	 */
	public function __construct(Miscellaneous $miscellaneous) {
		$this->miscellaneous = $miscellaneous;
		$this->api           = $miscellaneous->getApi();
	}
} 