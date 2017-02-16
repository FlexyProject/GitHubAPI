<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Forks API class provides access to repository's forks.
 * @link    https://developer.github.com/v3/repos/forks/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Forks extends AbstractRepositories {

	/**
	 * List forks
	 * @link https://developer.github.com/v3/repos/forks/#list-forks
	 * @param string $sort
	 * @return array
	 */
	public function listForks(string $sort = AbstractApi::SORT_NEWEST): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/forks?:arg', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), http_build_query(['sort' => $sort]))
		);
	}

	/**
	 * Create a fork
	 * @link https://developer.github.com/v3/repos/forks/#create-a-fork
	 * @param string $organization
	 * @return array
	 */
	public function createFork(string $organization = ''): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/forks', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			['organization' => $organization]
		);
	}
} 