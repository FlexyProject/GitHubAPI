<?php
namespace FlexyProject\GitHub\Receiver\Activity;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Activity;

abstract class AbstractActivity {

	protected $activity;
	protected $api;

	/**
	 * Constructor
	 * @param Activity $activity
	 */
	public function __construct(Activity $activity) {
		$this->setActivity($activity);
		$this->setApi($activity->getApi());
	}

	/**
	 * Get activity
	 * @return Activity
	 */
	public function getActivity() {
		return $this->activity;
	}

	/**
	 * Set activity
	 * @param Activity $activity
	 * @return $this
	 */
	public function setActivity($activity) {
		$this->activity = $activity;

		return $this;
	}

	/**
	 * Get api
	 * @return AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param AbstractApi $api
	 * @return $this
	 */
	public function setApi(AbstractApi $api) {
		$this->api = $api;

		return $this;
	}
} 