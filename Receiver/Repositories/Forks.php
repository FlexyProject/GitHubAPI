<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

/**
 * The Forks API class provides access to repository's forks.
 * @link    https://developer.github.com/v3/repos/forks/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Forks extends AbstractRepositories {

	/**
	 * List forks
	 * @link https://developer.github.com/v3/repos/forks/#list-forks
	 * @param string $sort
	 * @return mixed
	 */
	public function listForks($sort = AbstractApi::SORT_NEWEST) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/forks?:arg', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), http_build_query(['sort' => $sort]))
		);
	}

	/**
	 * Create a fork
	 * @link https://developer.github.com/v3/repos/forks/#create-a-fork
	 * @param string $organization
	 * @return mixed
	 */
	public function createFork($organization = '') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/forks', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			['organization' => $organization]
		);
	}
} 