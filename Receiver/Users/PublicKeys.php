<?php
namespace Scion\GitHub\Receiver\Users;

use Scion\Http\Request;

/**
 * The PublicKeys API class provide access to manage public keys.
 * @link    https://developer.github.com/v3/users/keys/
 * @package Scion\GitHub\Receiver\Users
 */
class PublicKeys extends AbstractUsers {

	/**
	 * List public keys for a user
	 * @link https://developer.github.com/v3/users/keys/#list-public-keys-for-a-user
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function listUserPublicKeys($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/keys', $username)
		);
	}

	/**
	 * List your public keys
	 * @link https://developer.github.com/v3/users/keys/#list-your-public-keys
	 * @return string
	 * @throws \Exception
	 */
	public function listYourPublicKeys() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/keys')
		);
	}

	/**
	 * Get a single public key
	 * @link https://developer.github.com/v3/users/keys/#get-a-single-public-key
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function getSinglePublicKey($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/keys/:id', (string)$id)
		);
	}

	/**
	 * Create a public key
	 * @link https://developer.github.com/v3/users/keys/#create-a-public-key
	 * @return string
	 * @throws \Exception
	 */
	public function createPublicKey() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/keys'),
			Request::METHOD_POST
		);
	}

	/**
	 * Delete a public key
	 * @link https://developer.github.com/v3/users/keys/#delete-a-public-key
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function deletePublicKey($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/keys/:id', (string)$id),
			Request::METHOD_DELETE
		);
	}
}