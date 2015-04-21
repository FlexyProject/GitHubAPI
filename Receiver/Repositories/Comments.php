<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

/**
 * The Comments API class provides access to repository's comments.
 * @link    https://developer.github.com/v3/repos/comments/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Comments extends AbstractRepositories {

	/**
	 * List commit comments for a repository
	 * @link https://developer.github.com/v3/repos/comments/#list-commit-comments-for-a-repository
	 * @return mixed
	 */
	public function listComments() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List comments for a single commit
	 * @link https://developer.github.com/v3/repos/comments/#list-comments-for-a-single-commit
	 * @param string $ref
	 * @return mixed
	 */
	public function listCommitComments($ref) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits/:ref/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref)
		);
	}

	/**
	 * Create a commit comment
	 * @link https://developer.github.com/v3/repos/comments/#create-a-commit-comment
	 * @param string $sha
	 * @param string $body
	 * @param string $path
	 * @param int    $position
	 * @return mixed
	 */
	public function addCommitComment($sha, $body, $path = '', $position = 0) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits/:sha/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha),
			Request::METHOD_POST,
			[
				'body'     => $body,
				'path'     => $path,
				'position' => $position
			]
		);
	}

	/**
	 * Get a single commit comment
	 * @link https://developer.github.com/v3/repos/comments/#get-a-single-commit-comment
	 * @param int $id
	 * @return mixed
	 */
	public function getCommitComment($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id)
		);
	}

	/**
	 * Update a commit comment
	 * @link https://developer.github.com/v3/repos/comments/#update-a-commit-comment
	 * @param int    $id
	 * @param string $body
	 * @return mixed
	 * @throws \Exception
	 */
	public function updateCommitComment($id, $body) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id),
			Request::METHOD_PATCH,
			[
				'body' => $body
			]
		);
	}

	/**
	 * Delete a commit comment
	 * @link https://developer.github.com/v3/repos/comments/#delete-a-commit-comment
	 * @param int $id
	 * @return mixed
	 */
	public function deleteCommitComment($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id),
			Request::METHOD_DELETE
		);
	}
} 