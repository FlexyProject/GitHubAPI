<?php
namespace FlexyProject\GitHub\Receiver\Users;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Users;

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
	public function getUsers(): Users {
		return $this->users;
	}

	/**
	 * Set users
	 * @param Users $users
	 * @return AbstractUsers
	 */
	public function setUsers(Users $users): AbstractUsers {
		$this->users = $users;

		return $this;
	}

	/**
	 * Get api
	 * @return AbstractApi
	 */
	public function getApi(): AbstractApi {
		return $this->api;
	}

	/**
	 * Set api
	 * @param AbstractApi $api
	 * @return AbstractUsers
	 */
	public function setApi(AbstractApi $api): AbstractUsers {
		$this->api = $api;

		return $this;
	}
} 