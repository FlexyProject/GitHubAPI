<?php
namespace FlexyProject\GitHub\Receiver\Activity;

use DateTime;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Notifications API class lets your view notifications of new comments are delivered to users and mark them as read.
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
	 * @return array
	 * @throws \Exception
	 */
	public function listNotifications(bool $all = false, bool $participating = false, string $since = 'now', string $before = null): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications?:args', http_build_query([
				'all'           => $all,
				'participating' => $participating,
				'since'         => (new DateTime($since))->format(DateTime::ATOM),
				'before'        => (new DateTime($before))->format(DateTime::ATOM)
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
	 * @return array
	 * @throws \Exception
	 */
	public function listRepositoryNotifications(bool $all = false, bool $participating = false, string $since = 'now', string $before = null): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/notifications?:args', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), http_build_query([
				'all'           => $all,
				'participating' => $participating,
				'since'         => (new DateTime($since))->format(DateTime::ATOM),
				'before'        => (new DateTime($before))->format(DateTime::ATOM)
			]))
		);
	}

	/**
	 * Mark as read
	 * @link https://developer.github.com/v3/activity/notifications/#mark-as-read
	 * @param string $lastReadAt
	 * @return array
	 */
	public function markAsRead(string $lastReadAt = 'now'): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications?:args', http_build_query(['last_read_at' => (new DateTime($lastReadAt))->format(DateTime::ATOM)])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Mark notifications as read in a repository
	 * @link https://developer.github.com/v3/activity/notifications/#mark-notifications-as-read-in-a-repository
	 * @param string $lastReadAt
	 * @return array
	 */
	public function markAsReadInRepository(string $lastReadAt = 'now'): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/notifications?:args', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), http_build_query(['last_read_at' => (new DateTime($lastReadAt))->format(DateTime::ATOM)])),
			Request::METHOD_PUT
		);
	}

	/**
	 *View a single thread
	 * @link https://developer.github.com/v3/activity/notifications/#view-a-single-thread
	 * @param int $id
	 * @return array
	 */
	public function viewThread(int $id): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications/threads/:id', (string)$id)
		);
	}

	/**
	 * Mark a thread as read
	 * @link https://developer.github.com/v3/activity/notifications/#mark-a-thread-as-read
	 * @param int $id
	 * @return array
	 */
	public function markThreadAsRead(int $id): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications/threads/:id', (string)$id),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Get a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#get-a-thread-subscription
	 * @param int $id
	 * @return array
	 */
	public function getThreadSubscription(int $id): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications/threads/:id/subscription', (string)$id)
		);
	}

	/**
	 * Set a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#set-a-thread-subscription
	 * @param int  $id
	 * @param bool $subscribed
	 * @param bool $ignored
	 * @return array
	 */
	public function setThreadSubscription(int $id, bool $subscribed = false, bool $ignored = false): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/notifications/threads/:id/subscription?:args', $id, http_build_query(['subscribed' => $subscribed, 'ignored' => $ignored])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Thread Subscription
	 * @link https://developer.github.com/v3/activity/notifications/#delete-a-thread-subscription
	 * @param int $id
	 * @return bool
	 */
	public function deleteThreadSubscription(int $id): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/notifications/threads/:id/subscription', (string)$id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}