<?php
namespace Scion\GitHub\Receiver\Activity;

use Scion\Http\Request;
use Scion\Stdlib\DateTime;

/**
 * Class Notifications
 * @link    https://developer.github.com/v3/activity/notifications/
 * @package GitHub\Receiver\Activity
 */
class Notifications extends AbstractActivity {

	/**
	 * List your notifications
	 * @link https://developer.github.com/v3/activity/notifications/#list-your-notifications
	 * @param bool   $all
	 * @param bool   $participating
	 * @param string $since
	 * @param string $before
	 * @return mixed
	 * @throws \Exception
	 */
	public function listNotifications($all = false, $participating = false, $since = 'now', $before = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications?:args', http_build_query([
				'all'           => $all,
				'participating' => $participating,
				'since'         => (new DateTime($since))->format(DateTime::ISO8601),
				'before'        => (new DateTime($before))->format(DateTime::ISO8601)
			]))
		);
	}

	/**
	 * List your notifications in a repository
	 * @link https://developer.github.com/v3/activity/notifications/#list-your-notifications-in-a-repository
	 * @param bool   $all
	 * @param bool   $participating
	 * @param string $since
	 * @param string $before
	 * @return mixed
	 * @throws \Exception
	 */
	public function listRepositoryNotifications($all = false, $participating = false, $since = 'now', $before = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/notifications?:args', http_build_query([
				'all'           => $all,
				'participating' => $participating,
				'since'         => (new DateTime($since))->format(DateTime::ISO8601),
				'before'        => (new DateTime($before))->format(DateTime::ISO8601)
			]))
		);
	}

	/**
	 * Mark as read
	 * @link https://developer.github.com/v3/activity/notifications/#mark-as-read
	 * @param string $lastReadAt
	 * @return mixed
	 */
	public function markAsRead($lastReadAt = 'now') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications?:args', http_build_query(['last_read_at' => (new DateTime($lastReadAt))->format(DateTime::ISO8601)])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Mark notifications as read in a repository
	 * @link https://developer.github.com/v3/activity/notifications/#mark-notifications-as-read-in-a-repository
	 * @param string $lastReadAt
	 * @return mixed
	 */
	public function markAsReadInRepository($lastReadAt = 'now') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/notifications?:args', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), http_build_query(['last_read_at' => (new DateTime($lastReadAt))->format(DateTime::ISO8601)])),
			Request::METHOD_PUT
		);
	}

	/**
	 *View a single thread
	 * @link https://developer.github.com/v3/activity/notifications/#view-a-single-thread
	 * @param int $id
	 * @return mixed
	 */
	public function viewThread($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications/threads/:id', (string)$id)
		);
	}

	/**
	 * Mark a thread as read
	 * @link https://developer.github.com/v3/activity/notifications/#mark-a-thread-as-read
	 * @param int $id
	 * @return mixed
	 */
	public function markThreadAsRead($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications/threads/:id', (string)$id),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Get a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#get-a-thread-subscription
	 * @param int $id
	 * @return mixed
	 */
	public function getThreadSubscription($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications/threads/:id/subscription', (string)$id)
		);
	}

	/**
	 * Set a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#set-a-thread-subscription
	 * @param int  $id
	 * @param bool $subscribed
	 * @param bool $ignored
	 * @return mixed
	 */
	public function setThreadSubscription($id, $subscribed = false, $ignored = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications/threads/:id/subscription?:args', $id, http_build_query(['subscribed' => $subscribed, 'ignored' => $ignored])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#delete-a-thread-subscription
	 * @param int $id
	 * @return boolean
	 */
	public function deleteThreadSubscription($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/notifications/threads/:id/subscription', (string)$id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}