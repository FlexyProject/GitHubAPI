<?php
namespace Scion\GitHub\Receiver;

use Scion\GitHub\AbstractApi;

abstract class AbstractReceiver {

	/** Protected properties */
	protected $api;
	protected $owner;
	protected $repo;

	/**
	 * Constructor
	 * @param AbstractApi $api
	 */
	public function __construct(AbstractApi $api) {
		$this->setApi($api);
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

	/**
	 * Get owner
	 * @return mixed
	 */
	public function getOwner() {
		return $this->owner;
	}

	/**
	 * Set owner
	 * @param string $owner
	 * @return $this
	 */
	public function setOwner($owner) {
		$this->owner = $owner;

		return $this;
	}

	/**
	 * Get repository
	 * @return mixed
	 */
	public function getRepo() {
		return $this->repo;
	}

	/**
	 * Set repository
	 * @param string $repo
	 * @return $this
	 */
	public function setRepo($repo) {
		$this->repo = $repo;

		return $this;
	}

	/**
	 * Get a sub-receiver
	 * @param string $name
	 * @return mixed
	 */
	public function getReceiver($name) {
		$classPath = explode('\\', get_called_class());
		$class     = sprintf('%s\%s\%s', __NAMESPACE__, end($classPath), $name);

		return new $class($this);
	}
} 