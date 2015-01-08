<?php
namespace GitHub\Receiver\Users;

use GitHub\Receiver\Users;

class AbstractUsers {

	protected $users;
	protected $api;

	/**
	 * Constructor
	 * @param Users $users
	 */
	public function __construct(Users $users) {
		$this->users = $users;
		$this->api   = $users->getApi();
	}
} 