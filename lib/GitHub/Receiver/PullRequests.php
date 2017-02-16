<?php
namespace FlexyProject\GitHub\Receiver;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class give you access to the Pull Request API who allows you to list, view, edit, create, and even merge pull requests.
 * @link    https://developer.github.com/v3/pulls/
 * @package FlexyProject\GitHub\Receiver
 */
class PullRequests extends AbstractReceiver {

	/** Available sub-Receiver */
	const REVIEW_COMMENTS = 'ReviewComments';

	/**
	 * List pull requests
	 * @link https://developer.github.com/v3/pulls/#list-pull-requests
	 * @param string $state
	 * @param string $head
	 * @param string $base
	 * @param string $sort
	 * @param string $direction
	 * @return array
	 * @throws \Exception
	 */
	public function listPullRequests(string $state = AbstractApi::STATE_OPEN, string $head = null, string $base = null, string $sort = AbstractApi::SORT_CREATED, string $direction = AbstractApi::DIRECTION_ASC): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls?:args', $this->getOwner(), $this->getRepo(), http_build_query([
				'state'     => $state,
				'head'      => $head,
				'base'      => $base,
				'sort'      => $sort,
				'direction' => $direction
			]))
		);
	}

	/**
	 * Get a single pull request
	 * @link https://developer.github.com/v3/pulls/#get-a-single-pull-request
	 * @param int $number
	 * @return array
	 * @throws \Exception
	 */
	public function getSinglePullRequest(int $number): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Create a pull request
	 * @link https://developer.github.com/v3/pulls/#create-a-pull-request
	 * @param string $title
	 * @param string $head
	 * @param string $base
	 * @param string $body
	 * @return array
	 * @throws \Exception
	 */
	public function createPullrequest(string $title, string $head, string $base, string $body): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls', $this->getOwner(), $this->getRepo()),
			Request::METHOD_POST,
			[
				'title' => $title,
				'head'  => $head,
				'base'  => $base,
				'body'  => $body
			]
		);
	}

	/**
	 * Update a pull request
	 * @link https://developer.github.com/v3/pulls/#update-a-pull-request
	 * @param int    $number
	 * @param string $title
	 * @param string $body
	 * @param string $state
	 * @return array
	 * @throws \Exception
	 */
	public function updatePullRequest(int $number, string $title = null, string$body = null, string$state = null): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_PATCH,
			[
				'title' => $title,
				'body'  => $body,
				'state' => $state
			]
		);
	}

	/**
	 * List commits on a pull request
	 * @link https://developer.github.com/v3/pulls/#list-commits-on-a-pull-request
	 * @param int $number
	 * @return array
	 * @throws \Exception
	 */
	public function listCommits(int $number): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/commits', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * List pull requests files
	 * @link https://developer.github.com/v3/pulls/#list-pull-requests-files
	 * @param int $number
	 * @return array
	 * @throws \Exception
	 */
	public function listPullRequestsFiles(int $number): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/files', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Get if a pull request has been merged
	 * @link https://developer.github.com/v3/pulls/#get-if-a-pull-request-has-been-merged
	 * @param int $number
	 * @return bool
	 * @throws \Exception
	 */
	public function checkPullRequestsMerged(int $number): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/merge', $this->getOwner(), $this->getRepo(), $number)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Merge a pull request (Merge Button)
	 * @link https://developer.github.com/v3/pulls/#merge-a-pull-request-merge-button
	 * @param int    $number
	 * @param string $commitMessage
	 * @param string $sha
	 * @return array
	 * @throws \Exception
	 */
	public function mergePullRequest(int $number, string $commitMessage = null, string $sha = null): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/merge', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_PUT,
			[
				'commit_message' => $commitMessage,
				'sha'            => $sha
			]
		);
	}
}