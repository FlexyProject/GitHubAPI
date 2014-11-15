<?php
namespace Scion\Services\GitHub\Receiver\Activity;

/**
 * Class Events
 * @see     https://developer.github.com/v3/activity/events/
 * @package Scion\Services\GitHub\Receiver\Activity
 */
class Events extends AbstractActivity {

	/**
	 * List public events
	 * @see https://developer.github.com/v3/activity/events/#list-public-events
	 * @return mixed
	 */
	public function listPublicEvents() {
		return $this->api->request(
			sprintf('/events')
		);
	}

	/**
	 * List repository events
	 * @see https://developer.github.com/v3/activity/events/#list-repository-events
	 * @return mixed
	 */
	public function listRepositoryEvents() {
		return $this->api->request(
			sprintf('/repos/%s/%s/events', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * List issue events for a repository
	 * @see https://developer.github.com/v3/activity/events/#list-issue-events-for-a-repository
	 * @return mixed
	 */
	public function listIssueEvents() {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/events', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * List public events for a network of repositories
	 * @see https://developer.github.com/v3/activity/events/#list-public-events-for-a-network-of-repositories
	 * @return mixed
	 */
	public function listPublicNetworkEvents() {
		return $this->api->request(
			sprintf('/networks/%s/%s/events', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * List public events for an organization
	 * @see https://developer.github.com/v3/activity/events/#list-public-events-for-an-organization
	 * @param string $organization
	 * @return mixed
	 */
	public function listPublicOrganizationEvents($organization) {
		return $this->api->request(
			sprintf('/orgs/%s/events', $organization)
		);
	}

	/**
	 * List events that a user has received
	 * @see https://developer.github.com/v3/activity/events/#list-events-that-a-user-has-received
	 * @param string $username
	 * @return mixed
	 */
	public function listUserReceiveEvents($username) {
		return $this->api->request(
			sprintf('/users/%s/received_events', $username)
		);
	}

	/**
	 * List public events that a user has received
	 * @see https://developer.github.com/v3/activity/events/#list-public-events-that-a-user-has-received
	 * @param string $username
	 * @return mixed
	 */
	public function listPublicUserReceiveEvents($username) {
		return $this->api->request(
			sprintf('/users/%s/received_events/public', $username)
		);
	}

	/**
	 * List events performed by a user
	 * @see https://developer.github.com/v3/activity/events/#list-events-performed-by-a-user
	 * @param string $username
	 * @return mixed
	 */
	public function listUserPerformedEvents($username) {
		return $this->api->request(
			sprintf('/users/%s/events', $username)
		);
	}

	/**
	 * List public events performed by a user
	 * @see https://developer.github.com/v3/activity/events/#list-public-events-performed-by-a-user
	 * @param string $username
	 * @return mixed
	 */
	public function listPublicUserPerformedEvents($username) {
		return $this->api->request(
			sprintf('/users/%s/events/public', $username)
		);
	}

	/**
	 * List events for an organization
	 * @see https://developer.github.com/v3/activity/events/#list-events-for-an-organization
	 * @param string $username
	 * @param string $organization
	 * @return mixed
	 */
	public function listOrganizationEvents($username, $organization) {
		return $this->api->request(
			sprintf('/users/%s/events/orgs/%s', $username, $organization)
		);
	}
} 