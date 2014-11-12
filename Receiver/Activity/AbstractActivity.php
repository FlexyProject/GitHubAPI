<?php
namespace Scion\Services\GitHub\Receiver\Activity;

use Scion\Services\GitHub\Receiver\Activity;

abstract class AbstractActivity {

	protected $activity;
	protected $api;

	/**
	 * Constructor
	 * @param Activity $activity
	 */
	public function __construct(Activity $activity) {
		$this->activity = $activity;
		$this->api      = $activity->getApi();
	}
} 