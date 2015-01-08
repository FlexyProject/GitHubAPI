<?php
namespace GitHub\Receiver\Repositories;

use Http\Request;
use GitHub\AbstractApi;

class Contents extends AbstractRepositories {

	/**
	 * Get the README
	 * @see https://developer.github.com/v3/repos/contents/#get-the-readme
	 * @return mixed
	 */
	public function getReadme() {
		return $this->getContents('readme');
	}

	/**
	 * This method returns the contents of a file or directory in a repository.
	 * @see https://developer.github.com/v3/repos/contents/#get-contents
	 * @param string $path
	 * @param string $ref
	 * @return mixed
	 */
	public function getContents($path = '', $ref = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/contents/%s?ref=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $path, $ref)
		);
	}

	/**
	 * Create a file
	 * @see https://developer.github.com/v3/repos/contents/#create-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $content
	 * @param string $branch
	 * @return mixed
	 */
	public function createFile($path, $message, $content, $branch = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/contents/%s?message=%s&content=%s&branch=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $path, $message, $content, $branch),
			Request::METHOD_PUT
		);
	}

	/**
	 * Update a file
	 * @see https://developer.github.com/v3/repos/contents/#update-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $content
	 * @param string $sha
	 * @param string $branch
	 * @return mixed
	 */
	public function updateFile($path, $message, $content, $sha, $branch = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/contents/%s?message=%s&content=%s&sha=%s&branch=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $path, $message, $content, $sha, $branch),
			Request::METHOD_PUT
		);
	}

	/**
	 * Delete a file
	 * @see https://developer.github.com/v3/repos/contents/#delete-a-file
	 * @param string $path
	 * @param string $message
	 * @param string $sha
	 * @param string $branch
	 * @return mixed
	 */
	public function deleteFile($path, $message, $sha, $branch = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/contents/%s?message=%s&sha=%s&branch=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $path, $message, $sha, $branch),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Get archive link
	 * @see https://developer.github.com/v3/repos/contents/#get-archive-link
	 * @param string $archiveFormat
	 * @param string $ref
	 * @return mixed
	 */
	public function getArchiveLink($archiveFormat = AbstractApi::ARCHIVE_TARBALL, $ref = AbstractApi::BRANCH_MASTER) {
		return $this->api->request(
			sprintf('/repos/%s/%s/%s/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $archiveFormat, $ref)
		);
	}
}