<?php
namespace Scion\GitHub\Receiver\Activity;

/**
 * Class Events
 * @link    https://developer.github.com/v3/activity/events/
 * @package GitHub\Receiver\Activity
 */
class Events extends AbstractActivity {

	/**
	 * List public events
	 * @link https://developer.github.com/v3/activity/events/#list-public-events
	 * @return mixed
	 */
	public function listPublicEvents() {
		return $this->getApi()->request(
			sprintf('/events')
		);
	}

	/**
	 * List repository events
	 * @link https://developer.github.com/v3/activity/events/#list-repository-events
	 * @return mixed
	 */
	public function listRepositoryEvents() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/events', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * List issue events for a repository
	 * @link https://developer.github.com/v3/activity/events/#list-issue-events-for-a-repository
	 * @return mixed
	 */
	public function listIssueEvents() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/events', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * List public events for a network of repositories
	 * @link https://developer.github.com/v3/activity/events/#list-public-events-for-a-network-of-repositories
	 * @return mixed
	 */
	public function listPublicNetworkEvents() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/networks/:owner/:repo/events', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * List public events for an organization
	 * @link https://developer.github.com/v3/activity/events/#list-public-events-for-an-organization
	 * @param string $organization
	 * @return mixed
	 */
	public function listPublicOrganizationEvents($organization) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/events', $organization)
		);
	}

	/**
	 * List events that a user has received
	 * @link https://developer.github.com/v3/activity/events/#list-events-that-a-user-has-received
	 * @param string $username
	 * @return mixed
	 */
	public function listUserReceiveEvents($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/received_events', $username)
		);
	}

	/**
	 * List public events that a user has received
	 * @link https://developer.github.com/v3/activity/events/#list-public-events-that-a-user-has-received
	 * @param string $username
	 * @return mixed
	 */
	public function listPublicUserReceiveEvents($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/received_events/public', $username)
		);
	}

	/**
	 * List events performed by a user
	 * @link https://developer.github.com/v3/activity/events/#list-events-performed-by-a-user
	 * @param string $username
	 * @return mixed
	 */
	public function listUserPerformedEvents($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/events', $username)
		);
	}

	/**
	 * List public events performed by a user
	 * @link https://developer.github.com/v3/activity/events/#list-public-events-performed-by-a-user
	 * @param string $username
	 * @return mixed
	 */
	public function listPublicUserPerformedEvents($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/events/public', $username)
		);
	}

	/**
	 * List events for an organization
	 * @link https://developer.github.com/v3/activity/events/#list-events-for-an-organization
	 * @param string $username
	 * @param string $organization
	 * @return mixed
	 */
	public function listOrganizationEvents($username, $organization) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/events/orgs/:org', $username, $organization)
		);
	}
} 