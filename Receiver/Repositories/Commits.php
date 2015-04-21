<?php
namespace Scion\GitHub\Receiver\Repositories;
use Scion\GitHub\AbstractApi;

/**
 * The Commits API class provides access to repository's commits.
 * @link    https://developer.github.com/v3/repos/commits/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Commits extends AbstractRepositories {

	/**
	 * List commits on a repository
	 * @link https://developer.github.com/v3/repos/commits/#list-commits-on-a-repository
	 * @param string      $sha
	 * @param string|null $path
	 * @param string|null $author
	 * @param string|null $since
	 * @param string|null $until
	 * @return mixed
	 */
	public function listCommits($sha = AbstractApi::BRANCH_MASTER, $path = null, $author = null, $since = null, $until = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits?:args', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), http_build_query([$sha, $path, $author, $since, $until]))
		);
	}

	/**
	 * Get a single commit
	 * @link https://developer.github.com/v3/repos/commits/#get-a-single-commit
	 * @param string $sha
	 * @return mixed
	 */
	public function getSingleCommit($sha) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits/:sha', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha)
		);
	}

	/**
	 * Compare two commits
	 * @link https://developer.github.com/v3/repos/commits/#compare-two-commits
	 * @param string $base
	 * @param string $head
	 * @return mixed
	 */
	public function compareTwoCommits($base, $head) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/compare/:base...:head', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $base, $head)
		);
	}
} 