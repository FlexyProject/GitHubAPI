<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

class Forks extends AbstractRepositories {

	/**
	 * List forks
	 * @see https://developer.github.com/v3/repos/forks/#list-forks
	 * @param string $sort
	 * @return mixed
	 */
	public function listForks($sort = AbstractApi::SORT_NEWEST) {
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