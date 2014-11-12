<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

use Scion\Http\Request;
use Scion\Services\GitHub\AbstractApi;
use Scion\Services\GitHub\Receiver\Repositories;

class Releases extends AbstractRepositories {

	/**
	 * List releases for a repository
	 * @see https://developer.github.com/v3/repos/releases/#list-releases-for-a-repository
	 * @return mixed
	 */
	public function listReleases() {
		return $this->api->request(
			sprintf('/repos/%s/%s/releases', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get a single release
	 * @see https://developer.github.com/v3/repos/releases/#get-a-single-release
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleRelease($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id)
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases?tag_name=%s&target_commitish=%s&name=%s&body=%s&draft=%s&prerelease=%s',
				$this->repositories->getOwner(),
				$this->repositories->getRepo(),
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/%s?tag_name=%s&target_commitish=%s&name=%s&body=%s&draft=%s&prerelease=%s',
				$id,
				$this->repositories->getOwner(),
				$this->repositories->getRepo(),
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id),
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/%s/assets', $this->repositories->getOwner(), $this->repositories->getRepo(), $id)
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/%s/assets?name=%s&content-type=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id, $name, $ContentType),
			Request::METHOD_POST,
			AbstractApi::API_UPLOADS
		);
	}

	/**
	 * Get a single release asset
	 * @see https://developer.github.com/v3/repos/releases/#get-a-single-release-asset
	 * @param string $id
	 * @return mixed
	 */
	public function getSingleReleaseAsset($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/assets/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id)
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
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/assets/%s?name=%s&label=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id, $name, $label)
		);
	}

	/**
	 * Delete a release asset
	 * @see https://developer.github.com/v3/repos/releases/#delete-a-release-asset
	 * @param string $id
	 * @return mixed
	 */
	public function deleteReleaseAsset($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/releases/assets/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
}