<?php
namespace Scion\GitHub\Receiver;

use Scion\Http\Request;

/**
 * This class give you access to the Users API.
 * @link    https://developer.github.com/v3/users/
 * @package Scion\GitHub\Receiver
 */
class Users extends AbstractReceiver {

	/** Available sub-Receiver */
	const EMAILS         = 'Emails';
	const FOLLOWERS      = 'Followers';
	const PUBLIC_KEYS    = 'PublicKeys';
	const ADMINISTRATION = 'Administration';

	/**
	 * Get a single user
	 * @link https://developer.github.com/v3/users/#get-a-single-user
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function getSingleUser($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username', $username)
		);
	}

	/**
	 * Get the authenticated user
	 * @link https://developer.github.com/v3/users/#get-the-authenticated-user
	 * @return string
	 * @throws \Exception
	 */
	public function getUser() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user')
		);
	}

	/**
	 * Update the authenticated user
	 * @link https://developer.github.com/v3/users/#update-the-authenticated-user
	 * @param string $name
	 * @param string $email
	 * @param string $blog
	 * @param string $company
	 * @param string $location
	 * @param bool   $hireable
	 * @param string $bio
	 * @return string
	 * @throws \Exception
	 */
	public function updateUser($name = null, $email = null, $blog = null, $company = null, $location = null, $hireable = false, $bio = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user'),
			Request::METHOD_PATCH,
			[
				'name'     => $name,
				'email'    => $email,
				'blog'     => $blog,
				'company'  => $company,
				'location' => $location,
				'hireable' => $hireable,
				'bio'      => $bio
			]
		);
	}

	/**
	 * Get all users
	 * @link https://developer.github.com/v3/users/#get-all-users
	 * @param string $since
	 * @return string
	 * @throws \Exception
	 */
	public function getAllUsers($since = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users?:args', http_build_query(['since' => $since]))
		);
	}
}