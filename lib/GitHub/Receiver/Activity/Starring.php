<?php
namespace GitHub\Receiver\Activity;

use Http\Request;
use GitHub\AbstractApi;

/**
 * Class Starring
 * @see     https://developer.github.com/v3/activity/starring/
 * @package GitHub\Receiver\Activity
 */
class Starring extends AbstractActivity {

	/**
	 * List Stargazers
	 * @see https://developer.github.com/v3/activity/starring/#list-stargazers
	 * @return mixed
	 */
	public function listStargazers() {
		return $this->api->request(
			sprintf('/repos/%s/%s/stargazers', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * List repositories being starred
	 * @see https://developer.github.com/v3/activity/starring/#list-repositories-being-starred
	 * @param string $sort
	 * @param string $direction
	 * @param null   $username
	 * @return mixed
	 */
	public function listRepositories($sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $username = null) {
		if (null !== $username) {
			return $this->api->request(
				sprintf('/users/%s/starred?sort=%s&direction=%s', $username, $sort, $direction)
			);
		}

		return $this->api->request(
			sprintf('/users/starred?sort=%s&direction=%s', $sort, $direction)
		);
	}

	/**
	 * Check if you are starring a repository
	 * @see https://developer.github.com/v3/activity/starring/#check-if-you-are-starring-a-repository
	 * @return mixed
	 */
	public function checkYouAreStarringRepository() {
		return $this->api->request(
			sprintf('/user/starred/%s/%s', $this->activity->getOwner(), $this->activity->getRepo())
		);
	}

	/**
	 * Star a repository
	 * @see https://developer.github.com/v3/activity/starring/#star-a-repository
	 * @return mixed
	 */
	public function starRepository() {
		return $this->api->request(
			sprintf('/user/starred/%s/%s', $this->activity->getOwner(), $this->activity->getRepo()),
			Request::METHOD_PUT
		);
	}

	/**
	 * Unstar a repository
	 * @see https://developer.github.com/v3/activity/starring/#unstar-a-repository
	 * @return mixed
	 */
	public function unStarRepository() {
		return $this->api->request(
			sprintf('/user/starred/%s/%s', $this->activity->getOwner(), $this->activity->getRepo()),
			Request::METHOD_DELETE
		);
	}
}