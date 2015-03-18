<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Hooks extends AbstractRepositories {

	/**
	 * List hooks
	 * @see https://developer.github.com/v3/repos/hooks/#list-hooks
	 * @return mixed
	 */
	public function listHooks() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get single hook
	 * @see https://developer.github.com/v3/repos/hooks/#get-single-hook
	 * @param int $id
	 * @return mixed
	 */
	public function getSingleHook($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Create a hook
	 * @see https://developer.github.com/v3/repos/hooks/#create-a-hook
	 * @param string $name
	 * @param string $config
	 * @param array  $events
	 * @param bool   $active
	 * @return mixed
	 */
	public function createHook($name, $config, $events = [], $active = true) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks?name=%s&config=%s&events=%s&active=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $name, $config, $events, $active),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit a hook
	 * @see https://developer.github.com/v3/repos/hooks/#edit-a-hook
	 * @param int    $id
	 * @param string $config
	 * @param array  $events
	 * @param array  $addEvents
	 * @param array  $removeEvents
	 * @param bool   $active
	 * @return mixed
	 */
	public function editHook($id, $config, $events = [], $addEvents = [], $removeEvents = [], $active = true) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks/%s?config=%s&events=%s&add_events=%s&remove_events=%s&active=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id, $config, $events, $addEvents, $removeEvents, $active),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Test a push hook
	 * @see https://developer.github.com/v3/repos/hooks/#test-a-push-hook
	 * @param int $id
	 * @return mixed
	 */
	public function testPushHook($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks/%s/tests', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_POST
		);
	}

	/**
	 * Ping a hook
	 * @see https://developer.github.com/v3/repos/hooks/#ping-a-hook
	 * @param int $id
	 * @return mixed
	 */
	public function pingHook($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks/%s/pings', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_POST
		);
	}

	/**
	 * Delete a hook
	 * @see https://developer.github.com/v3/repos/hooks/#delete-a-hook
	 * @param int $id
	 * @return mixed
	 */
	public function deleteHook($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/hooks/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
}