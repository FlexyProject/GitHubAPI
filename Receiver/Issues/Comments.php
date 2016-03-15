<?php
namespace FlexyProject\GitHub\Receiver\Issues;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Trees API class provides access to Issues's comments.
 * @link    https://developer.github.com/v3/issues/comments/
 * @package FlexyProject\GitHub\Receiver\Issues
 */
class Comments extends AbstractIssues {

	/**
	 * List comments on an issue
	 * @link https://developer.github.com/v3/issues/comments/#list-comments-on-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function listIssueComments($number) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/:number/comments', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number)
		);
	}

	/**
	 * List comments in a repository
	 * @link https://developer.github.com/v3/issues/comments/#list-comments-in-a-repository
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listRepositoryComments($sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = 'now') {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/comments?:args', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), http_build_query([
				'sort'      => $sort,
				'direction' => $direction,
				'since'     => $since
			]))
		);
	}

	/**
	 * Get a single comment
	 * @link https://developer.github.com/v3/issues/comments/#get-a-single-comment
	 * @param int $id
	 * @return mixed
	 */
	public function getComment($id) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/comments/:id', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id)
		);
	}

	/**
	 * Create a comment
	 * @link https://developer.github.com/v3/issues/comments/#create-a-comment
	 * @param int    $number
	 * @param string $body
	 * @return mixed
	 */
	public function createComment($number, $body) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/:number/comments', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number),
			Request::METHOD_POST,
			[
				'body' => $body
			]
		);
	}

	/**
	 * Edit a comment
	 * @link https://developer.github.com/v3/issues/comments/#edit-a-comment
	 * @param int    $id
	 * @param string $body
	 * @return mixed
	 */
	public function editComment($id, $body) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/comments/:id', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id),
			Request::METHOD_PATCH,
			[
				'body' => $body
			]
		);
	}

	/**
	 * Delete a comment
	 * @link https://developer.github.com/v3/issues/comments/#delete-a-comment
	 * @param int $id
	 * @return boolean
	 */
	public function deleteComment($id) {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/issues/comments/:id', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 