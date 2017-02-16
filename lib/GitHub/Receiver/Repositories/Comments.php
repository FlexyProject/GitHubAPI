<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Comments API class provides access to repository's comments.
 * @link    https://developer.github.com/v3/repos/comments/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Comments extends AbstractRepositories {

	/**
	 * List commit comments for a repository
	 * @link https://developer.github.com/v3/repos/comments/#list-commit-comments-for-a-repository
	 * @return array
	 */
	public function listComments(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List comments for a single commit
	 * @link https://developer.github.com/v3/repos/comments/#list-comments-for-a-single-commit
	 * @param string $ref
	 * @return array
	 */
	public function listCommitComments(string $ref): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/commits/:ref/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref)
		);
	}

	/**
	 * Create a commit comment
	 * @link https://developer.github.com/v3/repos/comments/#create-a-commit-comment
	 * @param string $sha
	 * @param string $body
	 * @param string $path
	 * @param int    $position
	 * @return array
	 */
	public function addCommitComment(string $sha, string $body, string $path = '', int $position = 0): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/commits/:sha/comments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha),
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
	 * @return array
	 */
	public function getCommitComment(int $id): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id)
		);
	}

	/**
	 * Update a commit comment
	 * @link https://developer.github.com/v3/repos/comments/#update-a-commit-comment
	 * @param int    $id
	 * @param string $body
	 * @return array
	 * @throws \Exception
	 */
	public function updateCommitComment(int $id, string $body): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id),
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
	 * @return array
	 */
	public function deleteCommitComment(int $id): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/comments/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), (string)$id),
			Request::METHOD_DELETE
		);
	}
} 