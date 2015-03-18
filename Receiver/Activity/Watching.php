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
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/subscribers', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
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
			return $this->getApi()->request(
				sprintf('/users/%s/subscriptions', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), $username)
			);
		}

		return $this->getApi()->request(
			sprintf('/user/subscriptions', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * Get a Repository Subscription
	 * @see https://developer.github.com/v3/activity/watching/#get-a-repository-subscription
	 * @return mixed
	 */
	public function getRepositorySubscription() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/subscription', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
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
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/subscription?subscribed=%s&ignored=%s', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), $subscribed, $ignored),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Repository Subscription
	 * @see https://developer.github.com/v3/activity/watching/#delete-a-repository-subscription
	 * @return mixed
	 */
	public function deleteRepositorySubscription() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/subscription', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Check if you are watching a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#check-if-you-are-watching-a-repository-legacy
	 * @return mixed
	 */
	public function userSubscriptions() {
		return $this->getApi()->request(
			sprintf('/user/subscriptions/%s/%s', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * Watch a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#watch-a-repository-legacy
	 * @return mixed
	 */
	public function watchRepository() {
		return $this->getApi()->request(
			sprintf('/user/subscriptions/%s/%s', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_PUT
		);
	}

	/**
	 * Stop watching a repository (LEGACY)
	 * @see https://developer.github.com/v3/activity/watching/#stop-watching-a-repository-legacy
	 * @return mixed
	 */
	public function stopWatchingRepository() {
		return $this->getApi()->request(
			sprintf('/user/subscriptions/%s/%s', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_DELETE
		);
	}
}