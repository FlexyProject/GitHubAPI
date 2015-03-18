<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Collaborators extends AbstractRepositories {

	/**
	 * List collaborators
	 * @see https://developer.github.com/v3/repos/collaborators/#list
	 * @return mixed
	 */
	public function listCollaborators() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/collaborators', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Check if a user is a collaborator
	 * @see https://developer.github.com/v3/repos/collaborators/#get
	 * @param string $username
	 * @return mixed
	 */
	public function checkUserIsACollaborator($username) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/collaborators/:%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username)
		);
	}

	/**
	 * Add user as a collaborator
	 * @see https://developer.github.com/v3/repos/collaborators/#add-collaborator
	 * @param string $username
	 * @return mixed
	 */
	public function addUserAsCollaborator($username) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/collaborators/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username),
			Request::METHOD_PUT
		);
	}

	/**
	 * Remove user as a collaborator
	 * @see https://developer.github.com/v3/repos/collaborators/#remove-collaborator
	 * @param string $username
	 * @return mixed
	 */
	public function removeUserAsCollaborator($username) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/collaborators/%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username),
			Request::METHOD_DELETE
		);
	}
} 