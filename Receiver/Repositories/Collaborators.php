<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Collaborators API class provides access to repository's collaborators
 * @link    https://developer.github.com/v3/repos/collaborators/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Collaborators extends AbstractRepositories {

	/**
	 * List collaborators
	 * @link https://developer.github.com/v3/repos/collaborators/#list
	 * @return array
	 */
	public function listCollaborators(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/collaborators', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * Check if a user is a collaborator
	 * @link https://developer.github.com/v3/repos/collaborators/#get
	 * @param string $username
	 * @return bool
	 */
	public function checkUserIsACollaborator(string $username): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/collaborators/:username', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Add user as a collaborator
	 * @link https://developer.github.com/v3/repos/collaborators/#add-collaborator
	 * @param string $username
	 * @return array
	 */
	public function addUserAsCollaborator(string $username): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/collaborators/:username', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username),
			Request::METHOD_PUT
		);
	}

	/**
	 * Remove user as a collaborator
	 * @link https://developer.github.com/v3/repos/collaborators/#remove-collaborator
	 * @param string $username
	 * @return array
	 */
	public function removeUserAsCollaborator(string $username): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/collaborators/:username', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $username),
			Request::METHOD_DELETE
		);
	}
} 