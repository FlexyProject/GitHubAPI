<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;
use Scion\GitHub\AbstractApi;

class Comments extends AbstractRepositories {

	/**
	 * List commit comments for a repository
	 * @see https://developer.github.com/v3/repos/comments/#list-commit-comments-for-a-repository
	 * @return mixed
	 */
	public function listComments() {
		return $this->api->request(
			sprintf('/repos/%s/%s/comments', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * List comments for a single commit
	 * @see https://developer.github.com/v3/repos/comments/#list-comments-for-a-single-commit
	 * @param $ref
	 * @return mixed
	 */
	public function listCommitComments($ref = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits/%s/comments', $this->repositories->getOwner(), $this->repositories->getRepo(), $ref)
		);
	}

	/**
	 * Create a commit comment
	 * @see https://developer.github.com/v3/repos/comments/#create-a-commit-comment
	 * @param string $sha
	 * @param string $body
	 * @param string $path
	 * @param int    $position
	 * @return mixed
	 */
	public function addCommitComment($sha, $body, $path = '', $position = 0) {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits/%s/comments?body=%s&path=%s&position=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $sha, $body, $path, $position),
			Request::METHOD_POST
		);
	}

	/**
	 * Get a single commit comment
	 * @see https://developer.github.com/v3/repos/comments/#get-a-single-commit-comment
	 * @param int $id
	 * @return mixed
	 */
	public function getCommitComment($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/comments/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id)
		);
	}

	/**
	 * Update a commit comment
	 * @see https://developer.github.com/v3/repos/comments/#update-a-commit-comment
	 * @param int $id
	 * @return mixed
	 */
	public function updateCommitComment($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/comments/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a commit comment
	 * @see https://developer.github.com/v3/repos/comments/#delete-a-commit-comment
	 * @param int $id
	 * @return mixed
	 */
	public function deleteCommitComment($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/comments/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
} 