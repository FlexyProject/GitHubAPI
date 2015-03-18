<?php
namespace Scion\GitHub\Receiver\Issues;

use Scion\Http\Request;
use Scion\GitHub\AbstractApi;

class Comments extends AbstractIssues {

	/**
	 * List comments on an issue
	 * @see https://developer.github.com/v3/issues/comments/#list-comments-on-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function listIssueComments($number) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/%s/comments', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number)
		);
	}

	/**
	 * List comments in a repository
	 * @see https://developer.github.com/v3/issues/comments/#list-comments-in-a-repository
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listRepositoryComments($sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/comments?sort=%s&direction=%s&since=%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $sort, $direction, $since)
		);
	}

	/**
	 * Get a single comment
	 * @see https://developer.github.com/v3/issues/comments/#get-a-single-comment
	 * @param int $id
	 * @return mixed
	 */
	public function getComment($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/comments/%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id)
		);
	}

	/**
	 * Create a comment
	 * @see https://developer.github.com/v3/issues/comments/#create-a-comment
	 * @param int    $number
	 * @param string $body
	 * @return mixed
	 */
	public function createComment($number, $body) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/%s/comments?body=%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number, $body),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit a comment
	 * @see https://developer.github.com/v3/issues/comments/#edit-a-comment
	 * @param int    $id
	 * @param string $body
	 * @return mixed
	 */
	public function editComment($id, $body) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/comments/%s?body=%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id, $body),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a comment
	 * @see https://developer.github.com/v3/issues/comments/#delete-a-comment
	 * @param int $id
	 * @return mixed
	 */
	public function deleteComment($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/comments/%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
} 