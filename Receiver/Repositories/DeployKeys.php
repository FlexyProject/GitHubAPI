<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use Symfony\Component\HttpFoundation\Request;

/**
 * The DeployKeys API class provides access to repository's deploy keys.
 * @link    https://developer.github.com/v3/repos/keys/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class DeployKeys extends AbstractRepositories {

	/**
	 * List deploy keys
	 * @link https://developer.github.com/v3/repos/keys/#list
	 * @return mixed
	 */
	public function listDeployKeys() {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/keys', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Get a deploy key
	 * @link https://developer.github.com/v3/repos/keys/#get
	 * @param int $id
	 * @return mixed
	 */
	public function getDeployKey($id) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/keys/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Add a new deploy key
	 * @link https://developer.github.com/v3/repos/keys/#create
	 * @param string $title
	 * @param string $key
	 * @return mixed
	 */
	public function addNewDeployKey($title, $key) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/keys', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			[
				'title' => $title,
				'key'   => $key
			]
		);
	}

	/**
	 * Remove a deploy key
	 * @link https://developer.github.com/v3/repos/keys/#delete
	 * @param int $id
	 * @return mixed
	 */
	public function removeDeployKey($id) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/keys/:id', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_DELETE
		);
	}
} 