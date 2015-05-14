<?php
namespace Scion\GitHub\Receiver\Organizations;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

/**
 * Hooks API class allow you to receive HTTP POST payloads whenever certain events happen within the organization.
 * @package Scion\GitHub\Receiver\Organizations
 */
class Hooks extends AbstractOrganizations {

	/**
	 * List hooks
	 * @link https://developer.github.com/v3/orgs/hooks/#list-hooks
	 * @param string $org
	 * @return string
	 * @throws \Exception
	 */
	public function listHooks($org) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks', $org)
		);
	}

	/**
	 * Get single hook
	 * @link https://developer.github.com/v3/orgs/hooks/#get-single-hook
	 * @param string $org
	 * @param int    $id
	 * @return string
	 * @throws \Exception
	 */
	public function getSingleHook($org, $id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id)
		);
	}

	/**
	 * Create a hook
	 * @link https://developer.github.com/v3/orgs/hooks/#create-a-hook
	 * @param string       $org
	 * @param string       $name
	 * @param string|array $config
	 * @param array        $events
	 * @param bool         $active
	 * @return string
	 * @throws \Exception
	 */
	public function createHook($org, $name, $config, $events = [AbstractApi::EVENTS_PUSH], $active = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks', $org),
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
	 * @link https://developer.github.com/v3/orgs/hooks/#edit-a-hook
	 * @param string       $org
	 * @param int          $id
	 * @param string|array $config
	 * @param array        $events
	 * @param bool         $active
	 * @return string
	 * @throws \Exception
	 */
	public function editHook($org, $id, $config, $events = [AbstractApi::EVENTS_PUSH], $active = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id),
			Request::METHOD_PATCH,
			[
				'config' => $config,
				'events' => $events,
				'active' => $active
			]
		);
	}

	/**
	 * Ping a hook
	 * @link https://developer.github.com/v3/orgs/hooks/#ping-a-hook
	 * @param string $org
	 * @param int    $id
	 * @return bool
	 * @throws \Exception
	 */
	public function pingHook($org, $id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks/:id/pings', $org, (string)$id),
			Request::METHOD_POST
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Delete a hook
	 * @link https://developer.github.com/v3/orgs/hooks/#delete-a-hook
	 * @param string $org
	 * @param int    $id
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteHook($org, $id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}