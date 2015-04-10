<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\AbstractApi;
use Scion\GitHub\Receiver\Repositories;
use Scion\Http\Request;

class Releases extends AbstractRepositories {

	/**
	 * List releases for a repository
	 * @see https://developer.github.com/v3/repos/releases/#list-releases-for-a-repository
	 * @return mixed
	 */
	public function listReleases() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get a single release
	 * @see https://developer.github.com/v3/repos/releases/#get-a-single-release
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleRelease($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Create a release
	 * @see https://developer.github.com/v3/repos/releases/#create-a-release
	 * @param string $tagName
	 * @param string $targetCommitish
	 * @param string $name
	 * @param string $body
	 * @param bool   $draft
	 * @param bool   $preRelease
	 * @return mixed
	 */
	public function createRelease($tagName, $targetCommitish = AbstractApi::BRANCH_MASTER, $name, $body, $draft = false, $preRelease = false) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases?tag_name=%s&target_commitish=%s&name=%s&body=%s&draft=%s&prerelease=%s',
				$this->getRepositories()->getOwner(),
				$this->getRepositories()->getRepo(),
				$tagName,
				$targetCommitish,
				$name,
				$body,
				$draft,
				$preRelease),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit a release
	 * @see https://developer.github.com/v3/repos/releases/#edit-a-release
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
			sprintf('/repos/%s/%s/releases/%s?tag_name=%s&target_commitish=%s&name=%s&body=%s&draft=%s&prerelease=%s',
				$id,
				$this->getRepositories()->getOwner(),
				$this->getRepositories()->getRepo(),
				$tagName,
				$targetCommitish,
				$name,
				$body,
				$draft,
				$preRelease),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a release
	 * @see https://developer.github.com/v3/repos/releases/#delete-a-release
	 * @param string $id
	 * @return mixed
	 */
	public function deleteRelease($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}

	/**
	 * List assets for a release
	 * @see https://developer.github.com/v3/repos/releases/#list-assets-for-a-release
	 * @param string $id
	 * @return mixed
	 */
	public function getReleaseAssets($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/%s/assets', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Upload a release asset
	 * @see https://developer.github.com/v3/repos/releases/#upload-a-release-asset
	 * @param string $id
	 * @param string $ContentType
	 * @param string $name
	 * @return mixed
	 */
	public function uploadReleaseAsset($id, $ContentType, $name) {
		$this->getApi()->setApiUrl(AbstractApi::API_UPLOADS);

		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/%s/assets?name=%s&content-type=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id, $name, $ContentType),
			Request::METHOD_POST
		);
	}

	/**
	 * Get a single release asset
	 * @see https://developer.github.com/v3/repos/releases/#get-a-single-release-asset
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleReleaseAsset($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/assets/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Edit a release asset
	 * @see https://developer.github.com/v3/repos/releases/#edit-a-release-asset
	 * @param string $id
	 * @param string $name
	 * @param string $label
	 * @return mixed
	 */
	public function editReleaseAsset($id, $name, $label = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/assets/%s?name=%s&label=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id, $name, $label)
		);
	}

	/**
	 * Delete a release asset
	 * @see https://developer.github.com/v3/repos/releases/#delete-a-release-asset
	 * @param string $id
	 * @return mixed
	 */
	public function deleteReleaseAsset($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/releases/assets/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
}