<?php
namespace Scion\GitHub\Receiver\Repositories;

class Commits extends AbstractRepositories {

	/**
	 * List commits on a repository
	 * @see https://developer.github.com/v3/repos/commits/#list-commits-on-a-repository
	 * @param string $sha
	 * @param string $path
	 * @param string $author
	 * @param string $since
	 * @param string $until
	 * @return mixed
	 */
	public function listCommits($sha = '', $path = '', $author = '', $since = '', $until = '') {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits?sha=%s&path=%s&author=%s&since=%s&until=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $sha, $path, $author, $since, $until)
		);
	}

	/**
	 * Get a single commit
	 * @see https://developer.github.com/v3/repos/commits/#get-a-single-commit
	 * @param string $sha
	 * @return mixed
	 */
	public function getSingleCommit($sha) {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $sha)
		);
	}

	/**
	 * Compare two commits
	 * @see https://developer.github.com/v3/repos/commits/#compare-two-commits
	 * @param string $base
	 * @param string $head
	 * @return mixed
	 */
	public function compareTwoCommits($base, $head) {
		return $this->api->request(
			sprintf('/repos/%s/%s/compare/%s...%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $base, $head)
		);
	}
} 