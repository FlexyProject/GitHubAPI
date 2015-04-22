<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

/**
 * The Hooks API class provides access to repository's hooks.
 * @link    https://developer.github.com/v3/repos/hooks/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Hooks extends AbstractRepositories {

	/**
	 * List hooks
	 * @link https://developer.github.com/v3/repos/hooks/#list-hooks
	 * @return mixed
	 */
	public function listHooks() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get single hook
	 * @link https://developer.github.com/v3/repos/hooks/#get-single-hook
	 * @param int $id
	 * @return mixed
	 */
	public function getSingleHook($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Create a hook
	 * @link https://developer.github.com/v3/repos/hooks/#create-a-hook
	 * @param string $name
	 * @param string $config
	 * @param array  $events
	 * @param bool   $active
	 * @return mixed
	 */
	public function createHook($name, $config, $events = ['push'], $active = true) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			[
				'name'   => $name,
				'config' => $config,
				'events' => $events,
				'active' => $active
			]
		);
	}

	/**
	 * Edit a hook
	 * @link https://developer.github.com/v3/repos/hooks/#edit-a-hook
	 * @param int    $id
	 * @param string $config
	 * @param array  $events
	 * @param array  $addEvents
	 * @param array  $removeEvents
	 * @param bool   $active
	 * @return mixed
	 */
	public function editHook($id, $config, $events = ['push'], $addEvents = [], $removeEvents = [], $active = true) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_PATCH,
			[
				'config'        => $config,
				'events'        => $events,
				'add_events'    => $addEvents,
				'remove_events' => $removeEvents,
				'active'        => $active
			]
		);
	}

	/**
	 * Test a push hook
	 * @link https://developer.github.com/v3/repos/hooks/#test-a-push-hook
	 * @param int $id
	 * @return mixed
	 */
	public function testPushHook($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks/:id/tests', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_POST
		);
	}

	/**
	 * Ping a hook
	 * @link https://developer.github.com/v3/repos/hooks/#ping-a-hook
	 * @param int $id
	 * @return mixed
	 */
	public function pingHook($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks/:id/pings', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_POST
		);
	}

	/**
	 * Delete a hook
	 * @link https://developer.github.com/v3/repos/hooks/#delete-a-hook
	 * @param int $id
	 * @return mixed
	 */
	public function deleteHook($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/hooks/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
}