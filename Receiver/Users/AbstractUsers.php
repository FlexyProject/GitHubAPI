<?php
namespace Scion\GitHub\Receiver\Users;

use Scion\GitHub\Receiver\Users;

class AbstractUsers {

	/** Properties */
	protected $users;
	protected $api;

	/**
	 * Constructor
	 * @param Users $users
	 */
	public function __construct(Users $users) {
		$this->setUsers($users);
		$this->setApi($users->getApi());
	}

	/**
	 * Get users
	 * @return Users
	 */
	public function getUsers() {
		return $this->users;
	}

	/**
	 * Set users
	 * @param Users $users
	 * @return AbstractUsers
	 */
	public function setUsers($users) {
		$this->users = $users;

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
	 * @return AbstractUsers
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 