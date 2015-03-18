<?php
namespace Scion\GitHub\Receiver\Activity;

use Scion\Http\Request;
use Scion\Stdlib\DateTime;

/**
 * Class Notifications
 * @see     https://developer.github.com/v3/activity/notifications/
 * @package GitHub\Receiver\Activity
 */
class Notifications extends AbstractActivity {

	/**
	 * List your notifications
	 * @see https://developer.github.com/v3/activity/notifications/#list-your-notifications
	 * @param bool   $all
	 * @param bool   $participating
	 * @param string $since
	 * @return mixed
	 */
	public function listNotifications($all = false, $participating = false, $since = 'now') {
		return $this->getApi()->request(
			sprintf('/notifications?all=%s&participating=%s&since=%s', $all, $participating, (new DateTime($since))->format(DateTime::ISO8601))
		);
	}

	/**
	 * List your notifications in a repository
	 * @see https://developer.github.com/v3/activity/notifications/#list-your-notifications-in-a-repository
	 * @param bool   $all
	 * @param bool   $participating
	 * @param string $since
	 * @return mixed
	 */
	public function listRepositoryNotifications($all = false, $participating = false, $since = 'now') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/notifications?all=%s&participating=%s&since=%s', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), $all, $participating, (new DateTime($since))->format(DateTime::ISO8601))
		);
	}

	/**
	 * Mark as read
	 * @see https://developer.github.com/v3/activity/notifications/#mark-as-read
	 * @param string $lastReadAt
	 * @return mixed
	 */
	public function markAsRead($lastReadAt = 'now') {
		return $this->getApi()->request(
			sprintf('/notifications?last_read_at=%s', (new DateTime($lastReadAt))->format(DateTime::ISO8601)),
			Request::METHOD_PUT
		);
	}

	/**
	 * Mark notifications as read in a repository
	 * @see https://developer.github.com/v3/activity/notifications/#mark-notifications-as-read-in-a-repository
	 * @param string $lastReadAt
	 * @return mixed
	 */
	public function markAsReadInRepository($lastReadAt = 'now') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/notifications', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), (new DateTime($lastReadAt))->format(DateTime::ISO8601)),
			Request::METHOD_PUT
		);
	}

	/**
	 *View a single thread
	 * @see https://developer.github.com/v3/activity/notifications/#view-a-single-thread
	 * @param int $id
	 * @return mixed
	 */
	public function viewThread($id) {
		return $this->getApi()->request(
			sprintf('/notifications/threads/%s', $id)
		);
	}

	/**
	 * Mark a thread as read
	 * @see https://developer.github.com/v3/activity/notifications/#mark-a-thread-as-read
	 * @param int $id
	 * @return mixed
	 */
	public function markThreadAsRead($id) {
		return $this->getApi()->request(
			sprintf('/notifications/threads/%s', $id),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Get a Thread Subscription
	 * @see https://developer.github.com/v3/activity/notifications/#get-a-thread-subscription
	 * @param int $id
	 * @return mixed
	 */
	public function getThreadSubscription($id) {
		return $this->getApi()->request(
			sprintf('/notifications/threads/%s/subscription', $id)
		);
	}

	/**
	 * Set a Thread Subscription
	 * @see https://developer.github.com/v3/activity/notifications/#set-a-thread-subscription
	 * @param int  $id
	 * @param bool $subscribed
	 * @param bool $ignored
	 * @return mixed
	 */
	public function setThreadSubscription($id, $subscribed = false, $ignored = false) {
		return $this->getApi()->request(
			sprintf('/notifications/threads/%s/subscription?subscribed=%s&ignored=%s', $id, $subscribed, $ignored),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Thread Subscription
	 * @see https://developer.github.com/v3/activity/notifications/#delete-a-thread-subscription
	 * @param int $id
	 * @return mixed
	 */
	public function deleteThreadSubscription($id) {
		return $this->getApi()->request(
			sprintf('/notifications/threads/%s/subscription', $id),
			Request::METHOD_DELETE
		);
	}
}