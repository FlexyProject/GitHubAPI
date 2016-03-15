<?php
namespace FlexyProject\GitHub\Receiver\PullRequests;

use DateTime;
use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pull Request API class Review Comments are comments on a portion of the unified diff.
 * @link    https://developer.github.com/v3/pulls/comments/
 * @package FlexyProject\GitHub\Receiver\PullRequests
 */
class ReviewComments extends AbstractPullRequests {

	/**
	 * List comments on a pull request
	 * @link https://developer.github.com/v3/pulls/comments/#list-comments-on-a-pull-request
	 * @param int $number
	 * @return string
	 * @throws \Exception
	 */
	public function listCommentsPullRequest($number) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/comments', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), $number)
		);
	}

	/**
	 * List comments in a repository
	 * @link https://developer.github.com/v3/pulls/comments/#list-comments-in-a-repository
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return string
	 * @throws \Exception
	 */
	public function listCommentsRepository($sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = 'now') {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/comments?:args', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), http_build_query([
				'sort'      => $sort,
				'direction' => $direction,
				'since'     => (new DateTime($since))->format(DateTime::ATOM)
			]))
		);
	}

	/**
	 * Get a single comment
	 * @link https://developer.github.com/v3/pulls/comments/#get-a-single-comment
	 * @param int $number
	 * @return string
	 * @throws \Exception
	 */
	public function getSingleComment($number) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/comments/:number', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), $number)
		);
	}

	/**
	 * Create a comment
	 * @link https://developer.github.com/v3/pulls/comments/#create-a-comment
	 * @param int    $number
	 * @param string $body
	 * @param string $commitId
	 * @param string $path
	 * @param int    $position
	 * @return string
	 * @throws \Exception
	 */
	public function createComment($number, $body, $commitId, $path, $position) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/:number/comments', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), $number),
			Request::METHOD_POST,
			[
				'body'      => $body,
				'commit_id' => $commitId,
				'path'      => $path,
				'position'  => $position
			]
		);
	}

	/**
	 * Edit a comment
	 * @link https://developer.github.com/v3/pulls/comments/#edit-a-comment
	 * @param int    $number
	 * @param string $body
	 * @return string
	 * @throws \Exception
	 */
	public function editComment($number, $body) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/comments/:number', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), $number),
			Request::METHOD_PATCH,
			[
				'body' => $body
			]
		);
	}

	/**
	 * Delete a comment
	 * @link https://developer.github.com/v3/pulls/comments/#delete-a-comment
	 * @param int $number
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteComment($number) {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/pulls/comments/:number', $this->getPullRequests()->getOwner(), $this->getPullRequests()->getRepo(), $number)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}