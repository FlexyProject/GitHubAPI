<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class DeployKeys extends AbstractRepositories {

	/**
	 * List deploy keys
	 * @see https://developer.github.com/v3/repos/keys/#list
	 * @return mixed
	 */
	public function listDeployKeys() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/keys', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get a deploy key
	 * @see https://developer.github.com/v3/repos/keys/#get
	 * @param int $id
	 * @return mixed
	 */
	public function getDeployKey($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/keys/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
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
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/keys?title=%s&key=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $title, $key),
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
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/keys/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
} 