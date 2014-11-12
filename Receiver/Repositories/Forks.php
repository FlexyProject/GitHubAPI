<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Forks extends AbstractRepositories {

	/**
	 * List forks
	 * @see https://developer.github.com/v3/repos/forks/#list-forks
	 * @param string $sort
	 * @return mixed
	 */
	public function listForks($sort = self::SORT_NEWEST) {
		return $this->api->request(
			sprintf('/repos/%s/%s/forks?sort=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $sort)
		);
	}

	/**
	 * Create a fork
	 * @see https://developer.github.com/v3/repos/forks/#create-a-fork
	 * @param string $organization
	 * @return mixed
	 */
	public function createFork($organization = '') {
		return $this->api->request(
			sprintf('/repos/%s/%s/forks?organization=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $organization),
			Request::METHOD_POST
		);
	}
} 