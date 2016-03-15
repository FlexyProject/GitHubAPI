<?php
namespace FlexyProject\GitHub\Receiver\Activity;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Watching API class registers the user to receive notifications on new discussions, as well as events in the user’s activity feed.
 * @link    https://developer.github.com/v3/activity/watching/
 * @package GitHub\Receiver\Activity
 */
class Watching extends AbstractActivity {

	/**
	 * List watchers
	 * @link https://developer.github.com/v3/activity/watching/#list-watchers
	 * @return array
	 */
	public function listWatchers(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/subscribers', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * List repositories being watched
	 * @link https://developer.github.com/v3/activity/watching/#list-repositories-being-watched
	 * @param string $username
	 * @return array
	 */
	public function listSubscriptions(string $username = null): array {
		if (null !== $username) {
			return $this->getApi()->request(
				$this->getApi()->sprintf('/users/:username/subscriptions', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), $username)
			);
		}

		return $this->getApi()->request(
			$this->getApi()->sprintf('/user/subscriptions', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * Get a Repository Subscription
	 * @link https://developer.github.com/v3/activity/watching/#get-a-repository-subscription
	 * @return array
	 */
	public function getRepositorySubscription(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/subscription', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * Set a Repository Subscription
	 * @link https://developer.github.com/v3/activity/watching/#set-a-repository-subscription
	 * @param bool $subscribed
	 * @param bool $ignored
	 * @return array
	 */
	public function setRepositorySubscription(bool $subscribed = false, bool $ignored = false): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/subscription?:args', $this->getActivity()->getOwner(), $this->getActivity()->getRepo(), http_build_query([
				'subscribed' => $subscribed,
				'ignored'    => $ignored
			])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a Repository Subscription
	 * @link https://developer.github.com/v3/activity/watching/#delete-a-repository-subscription
	 * @return bool
	 */
	public function deleteRepositorySubscription(): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/subscription', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Check if you are watching a repository (LEGACY)
	 * @link https://developer.github.com/v3/activity/watching/#check-if-you-are-watching-a-repository-legacy
	 * @return bool
	 */
	public function userSubscriptions(): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/subscriptions/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Watch a repository (LEGACY)
	 * @link https://developer.github.com/v3/activity/watching/#watch-a-repository-legacy
	 * @return bool
	 */
	public function watchRepository(): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/subscriptions/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_PUT
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Stop watching a repository (LEGACY)
	 * @link https://developer.github.com/v3/activity/watching/#stop-watching-a-repository-legacy
	 * @return bool
	 */
	public function stopWatchingRepository(): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/subscriptions/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}