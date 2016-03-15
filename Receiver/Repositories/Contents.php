<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Contents API class provides access to repository's contents.
 * @link    https://developer.github.com/v3/repos/contents/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Contents extends AbstractRepositories {

	/**
	 * Get the README
	 * @link https://developer.github.com/v3/repos/contents/#get-the-readme
	 * @return array
	 */
	public function getReadme(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/readme', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * This method returns the contents of a file or directory in a repository.
	 * @link https://developer.github.com/v3/repos/contents/#get-contents
	 * @param string $path
	 * @param string $ref
	 * @return array
	 */
	public function getContents(string $path = '', string $ref = AbstractApi::BRANCH_MASTER): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/contents/:path?:args', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $path, http_build_query(['ref' => $ref]))
		);
	}

	/**
	 * Create a file
	 * @link https://developer.github.com/v3/repos/contents/#create-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $content
	 * @param string $branch
	 * @return array
	 */
	public function createFile(string $path, string $message, string $content, string $branch = AbstractApi::BRANCH_MASTER): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/contents/:path?:args', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $path, http_build_query(['message' => $message, 'content' => $content, 'branch' => $branch])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Update a file
	 * @link https://developer.github.com/v3/repos/contents/#update-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $content
	 * @param string $sha
	 * @param string $branch
	 * @return array
	 */
	public function updateFile(string $path, string $message, string $content, string $sha, string $branch = AbstractApi::BRANCH_MASTER): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/contents/:path?:args', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $path, http_build_query(['message' => $message, 'content' => $content, 'sha' => $sha, 'branch' => $branch])),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a file
	 * @link https://developer.github.com/v3/repos/contents/#delete-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $sha
	 * @param string $branch
	 * @return array
	 */
	public function deleteFile(string $path, string $message, string $sha, string $branch = AbstractApi::BRANCH_MASTER): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/contents/:path', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $path),
			Request::METHOD_DELETE,
			[
				'message' => $message,
				'sha'     => $sha,
				'branch'  => $branch
			]
		);
	}

	/**
	 * Get archive link
	 * @link https://developer.github.com/v3/repos/contents/#get-archive-link
	 * @param string $archiveFormat
	 * @param string $ref
	 * @return array
	 */
	public function getArchiveLink(string $archiveFormat = AbstractApi::ARCHIVE_TARBALL, string $ref = AbstractApi::BRANCH_MASTER): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/:archive_format/:ref', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $archiveFormat, $ref)
		);
	}
}