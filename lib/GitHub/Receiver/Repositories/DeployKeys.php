<?php
namespace GitHub\Receiver\Repositories;

use Http\Request;

class DeployKeys extends AbstractRepositories {

	/**
	 * List deploy keys
	 * @see https://developer.github.com/v3/repos/keys/#list
	 * @return mixed
	 */
	public function listDeployKeys() {
		return $this->api->request(
			sprintf('/repos/%s/%s/keys', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get a deploy key
	 * @see https://developer.github.com/v3/repos/keys/#get
	 * @param int $id
	 * @return mixed
	 */
	public function getDeployKey($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/keys/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id)
		);
	}

	/**
	 * Add a new deploy key
	 * @see https://developer.github.com/v3/repos/keys/#create
	 * @param string $title
	 * @param string $key
	 * @return mixed
	 */
	public function addNewDeployKey($title, $key) {
		return $this->api->request(
			sprintf('/repos/%s/%s/keys?title=%s&key=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $title, $key),
			Request::METHOD_POST
		);
	}

	/**
	 * Remove a deploy key
	 * @see https://developer.github.com/v3/repos/keys/#delete
	 * @param int $id
	 * @return mixed
	 */
	public function removeDeployKey($id) {
		return $this->api->request(
			sprintf('/repos/%s/%s/keys/%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
} 