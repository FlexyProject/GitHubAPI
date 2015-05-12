<?php
namespace Scion\GitHub\Receiver\Users;

use Scion\Http\Request;

/**
 * The Emails API class provide access to manage email addresses.
 * @link    https://developer.github.com/v3/users/emails/
 * @package Scion\GitHub\Receiver\Users
 */
class Emails extends AbstractUsers {

	/**
	 * List email addresses for a user
	 * @link https://developer.github.com/v3/users/emails/#list-email-addresses-for-a-user
	 * @return string
	 * @throws \Exception
	 */
	public function listEmailAddresses() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/emails')
		);
	}

	/**
	 * Add email address(es)
	 * @link https://developer.github.com/v3/users/emails/#add-email-addresses
	 * @param array $addresses
	 * @return string
	 * @throws \Exception
	 */
	public function addEmailAddress($addresses = []) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/emails'),
			Request::METHOD_POST,
			$addresses
		);
	}

	/**
	 * Delete email address(es)
	 * @link https://developer.github.com/v3/users/emails/#delete-email-addresses
	 * @param array $addresses
	 * @return boolean
	 * @throws \Exception
	 */
	public function deleteEmailAddress($addresses = []) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/emails'),
			Request::METHOD_DELETE,
			$addresses
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 