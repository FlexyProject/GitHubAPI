<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\AbstractApi;
use Scion\GitHub\Receiver\Repositories;
use Scion\Http\Request;

/**
 * The Releases API class provides access to repository's releases.
 * @link    https://developer.github.com/v3/repos/releases/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Releases extends AbstractRepositories {

	/**
	 * List releases for a repository
	 * @link https://developer.github.com/v3/repos/releases/#list-releases-for-a-repository
	 * @return mixed
	 */
	public function listReleases() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get a single release
	 * @link https://developer.github.com/v3/repos/releases/#get-a-single-release
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleRelease($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Get the latest release
	 * @link https://developer.github.com/v3/repos/releases/#get-the-latest-release
	 * @return string
	 * @throws \Exception
	 */
	public function getLatestRelease() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/latest', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get a release by tag name
	 * @link https://developer.github.com/v3/repos/releases/#get-a-release-by-tag-name
	 * @param string $tag
	 * @return string
	 * @throws \Exception
	 */
	public function getReleaseByTagName($tag) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/tags/:tag', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $tag)
		);
	}

	/**
	 * Create a release
	 * @link https://developer.github.com/v3/repos/releases/#create-a-release
	 * @param string $tagName
	 * @param string $targetCommitish
	 * @param string $name
	 * @param string $body
	 * @param bool   $draft
	 * @param bool   $preRelease
	 * @return mixed
	 */
	public function createRelease($tagName, $targetCommitish = AbstractApi::BRANCH_MASTER, $name = null, $body = null, $draft = false, $preRelease = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			[
				'tag_name'         => $tagName,
				'target_commitish' => $targetCommitish,
				'name'             => $name,
				'body'             => $body,
				'draft'            => $draft,
				'prerelease'       => $preRelease
			]
		);
	}

	/**
	 * Edit a release
	 * @link https://developer.github.com/v3/repos/releases/#edit-a-release
	 * @param string $id
	 * @param string $tagName
	 * @param string $targetCommitish
	 * @param string $name
	 * @param string $body
	 * @param bool   $draft
	 * @param bool   $preRelease
	 * @return mixed
	 */
	public function editRelease($id, $tagName, $targetCommitish = AbstractApi::BRANCH_MASTER, $name, $body, $draft = false, $preRelease = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_PATCH,
			[
				'tag_name'         => $tagName,
				'target_commitish' => $targetCommitish,
				'name'             => $name,
				'body'             => $body,
				'draft'            => $draft,
				'prerelease'       => $preRelease
			]
		);
	}

	/**
	 * Delete a release
	 * @link https://developer.github.com/v3/repos/releases/#delete-a-release
	 * @param string $id
	 * @return boolean
	 */
	public function deleteRelease($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * List assets for a release
	 * @link https://developer.github.com/v3/repos/releases/#list-assets-for-a-release
	 * @param string $id
	 * @return mixed
	 */
	public function getReleaseAssets($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/:id/assets', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Upload a release asset
	 * @link https://developer.github.com/v3/repos/releases/#upload-a-release-asset
	 * @param string $id
	 * @param string $contentType
	 * @param string $name
	 * @return mixed
	 */
	public function uploadReleaseAsset($id, $contentType, $name) {

		return $this->getApi()->setApiUrl(AbstractApi::API_UPLOADS)->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/:id/assets?:arg', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id, http_build_query(['name' => $name])),
			Request::METHOD_POST,
			[
				'Content-Type' => $contentType
			]
		);
	}

	/**
	 * Get a single release asset
	 * @link https://developer.github.com/v3/repos/releases/#get-a-single-release-asset
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleReleaseAsset($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/assets/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Edit a release asset
	 * @link https://developer.github.com/v3/repos/releases/#edit-a-release-asset
	 * @param string $id
	 * @param string $name
	 * @param string $label
	 * @return mixed
	 */
	public function editReleaseAsset($id, $name, $label = '') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/assets/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_PATCH,
			[
				'name'  => $name,
				'label' => $label
			]
		);
	}

	/**
	 * Delete a release asset
	 * @link https://developer.github.com/v3/repos/releases/#delete-a-release-asset
	 * @param string $id
	 * @return boolean
	 */
	public function deleteReleaseAsset($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/releases/assets/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
}