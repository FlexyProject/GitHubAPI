<?php
namespace Scion\GitHub\Receiver\Activity;

use Scion\Http\Request;

/**
 * Class Watching
 * @see     https://developer.github.com/v3/activity/watching/
 * @package GitHub\Receiver\Activity
 */
class Watching extends AbstractActivity {

	/**
	 * List watchers
	 * @see https://developer.github.com/v3/activity/watching/#list-watchers
	 * @return mixed
	 */
	public function listWatchers() {
		return $this->api->request(
			sprintf('/repos/%s/%s/subscribers', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * List repositories being watched
	 * @see https://developer.github.com/v3/activity/watching/#list-repositories-being-watched
	 * @param string $username
	 * @return mixed
	 */
	public function listSubscriptions($username = null) {
		if (null !== $username) {
			return $this->api->request(
				sprintf('/users/%s/subscriptions', $this->activity->getOwner(), $this->activity->getRepo(), $username)
			);
		}

		return $this->api->request(
			sprintf('/user/subscriptions', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * Get a Repository Subscription
	 * @see https://developer.github.com/v3/activity/watching/#get-a-repository-subscription
	 * @return mixed
	 */
	public function getRepositorySubscription() {
		return $this->api->request(
			sprintf('/repos/%s/%s/subscription', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * Set a Repository Subscription
	 * @see https://developer.github.com/v3/activity/watching/#set-a-repository-subscription
	 * @param bool $subscribed
	 * @param bool $ignored
	 * @return mixed
	 */
	public function setRepositorySubscription($subscribed = false, $ignored = false) {
		return $this->api->request(
			sprintf('/repos/%s/%s/subscription?subscribed=%s&ignored=%s', $this->activity->getOwner(), $this->activity->getRepo(), $subscribed, $ignored),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Repository Subscription
	 * @see https://developer.github.com/v3/activity/watching/#delete-a-repository-subscription
	 * @return mixed
	 */
	public function deleteRepositorySubscription() {
		return $this->api->request(
			sprintf('/repos/%s/%s/subscription', $this->activity->getOwner(), $this->activity->getRepo()),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Check if you are watching a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#check-if-you-are-watching-a-repository-legacy
	 * @return mixed
	 */
	public function userSubscriptions() {
		return $this->api->request(
			sprintf('/user/subscriptions/%s/%s', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * Watch a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#watch-a-repository-legacy
	 * @return mixed
	 */
	public function watchRepository() {
		return $this->api->request(
			sprintf('/user/subscriptions/%s/%s', $this->activity->getOwner(), $this->activity->getRepo()),
			Request::METHOD_PUT
		);
	}

	/**
	 * Stop watching a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#stop-watching-a-repository-legacy
	 * @return mixed
	 */
	public function stopWatchingRepository() {
		return $this->api->request(
			sprintf('/user/subscriptions/%s/%s', $this->activity->getOwner(), $this->activity->getRepo()),
			Request::METHOD_DELETE
		);
	}
}