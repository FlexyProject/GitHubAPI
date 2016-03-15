<?php
namespace FlexyProject\GitHub\Receiver\Activity;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Starring API class provide a feature that lets users bookmark repositories.
 * @link    https://developer.github.com/v3/activity/starring/
 * @package GitHub\Receiver\Activity
 */
class Starring extends AbstractActivity {

	/**
	 * List Stargazers
	 * @link https://developer.github.com/v3/activity/starring/#list-stargazers
	 * @return mixed
	 */
	public function listStargazers() {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/stargazers', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);
	}

	/**
	 * List repositories being starred
	 * @link https://developer.github.com/v3/activity/starring/#list-repositories-being-starred
	 * @param string $sort
	 * @param string $direction
	 * @param null   $username
	 * @return mixed
	 */
	public function listRepositories($sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $username = null) {
		if (null !== $username) {
			return $this->getApi()->request(
				$this->getApi()->sprintf('/users/:username/starred?:args', $username, http_build_query(['sort' => $sort, 'direction' => $direction]))
			);
		}

		return $this->getApi()->request(
			$this->getApi()->sprintf('/user/starred?:args', http_build_query(['sort' => $sort, 'direction' => $direction]))
		);
	}

	/**
	 * Check if you are starring a repository
	 * @link https://developer.github.com/v3/activity/starring/#check-if-you-are-starring-a-repository
	 * @return boolean
	 */
	public function checkYouAreStarringRepository() {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/starred/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo())
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Star a repository
	 * @link https://developer.github.com/v3/activity/starring/#star-a-repository
	 * @return boolean
	 */
	public function starRepository() {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/starred/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_PUT
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Unstar a repository
	 * @link https://developer.github.com/v3/activity/starring/#unstar-a-repository
	 * @return boolean
	 */
	public function unStarRepository() {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/starred/:owner/:repo', $this->getActivity()->getOwner(), $this->getActivity()->getRepo()),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}