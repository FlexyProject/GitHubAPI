<?php
namespace Scion\GitHub\Receiver\Organizations;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

class Teams extends AbstractOrganizations {

	/**
	 * List teams
	 * @link https://developer.github.com/v3/orgs/teams/#list-teams
	 * @param string $org
	 * @return string
	 * @throws \Exception
	 */
	public function listTeams($org) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/teams', $org)
		);
	}

	/**
	 * Get team
	 * @link https://developer.github.com/v3/orgs/teams/#get-team
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function getTeam($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id', (string)$id)
		);
	}

	/**
	 * Create team
	 * @link https://developer.github.com/v3/orgs/teams/#create-team
	 * @param string      $org
	 * @param string      $name
	 * @param null|string $description
	 * @param array       $repoNames
	 * @param string      $permission
	 * @return string
	 * @throws \Exception
	 */
	public function createTeam($org, $name, $description = null, $repoNames = [], $permission = AbstractApi::PERMISSION_PULL) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/teams', $org),
			Request::METHOD_POST,
			[
				'name'        => $name,
				'description' => $description,
				'repo_names'  => $repoNames,
				'permission'  => $permission
			]
		);
	}

	/**
	 * Edit team
	 * @link https://developer.github.com/v3/orgs/teams/#edit-team
	 * @param int         $id
	 * @param string      $name
	 * @param null|string $description
	 * @param string      $permission
	 * @return string
	 * @throws \Exception
	 */
	public function editTeam($id, $name, $description = null, $permission = AbstractApi::PERMISSION_PULL) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id', (string)$id),
			Request::METHOD_PATCH,
			[
				'name'        => $name,
				'description' => $description,
				'permission'  => $permission
			]
		);
	}

	/**
	 * Delete team
	 * @link https://developer.github.com/v3/orgs/teams/#delete-team
	 * @param int $id
	 * @return bool
	 * @throws \Exception
	 */
	public function deleteTeam($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id', (string)$id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * List team members
	 * @link https://developer.github.com/v3/orgs/teams/#list-team-members
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function listTeamMembers($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/members', (string)$id)
		);
	}

	/**
	 * Get team membership
	 * @link https://developer.github.com/v3/orgs/teams/#get-team-membership
	 * @param int    $id
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function getTeamMembership($id, $username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/memberships/:username', (string)$id, $username)
		);
	}

	/**
	 * Add team membership
	 * @link https://developer.github.com/v3/orgs/teams/#add-team-membership
	 * @param int    $id
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function addTeamMembership($id, $username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/memberships/:username', (string)$id, $username),
			Request::METHOD_PUT
		);
	}

	/**
	 * Remove team membership
	 * @link https://developer.github.com/v3/orgs/teams/#remove-team-membership
	 * @param int    $id
	 * @param string $username
	 * @return bool
	 * @throws \Exception
	 */
	public function removeTeamMembership($id, $username) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/memberships/:username', (string)$id, $username),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * List team repos
	 * @link https://developer.github.com/v3/orgs/teams/#list-team-repos
	 * @param int $id
	 * @return string
	 * @throws \Exception
	 */
	public function listTeamRepos($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/repos', (string)$id)
		);
	}

	/**
	 * Check if a team manages a repository
	 * @link https://developer.github.com/v3/orgs/teams/#get-team-repo
	 * @param int $id
	 * @return bool
	 * @throws \Exception
	 */
	public function checkTeamManagesRepository($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/repos/:owner/:repo', (string)$id, $this->getOrganizations()->getOwner(), $this->getOrganizations()->getRepo())
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Add team repository
	 * @link https://developer.github.com/v3/orgs/teams/#add-team-repo
	 * @param int $id
	 * @return bool|string
	 * @throws \Exception
	 */
	public function addTeamRepository($id) {
		$return = $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/repos/:org/:repo', (string)$id, $this->getOrganizations()->getOwner(), $this->getOrganizations()->getRepo()),
			Request::METHOD_PUT
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return $return;
	}

	/**
	 * Remove team repository
	 * @link https://developer.github.com/v3/orgs/teams/#remove-team-repo
	 * @return bool
	 * @throws \Exception
	 */
	public function removeTeamRepository() {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/teams/:id/repos/:owner/:repo', (string)$id, $this->getOrganizations()->getOwner(), $this->getOrganizations()->getRepo()),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * List user teams
	 * @link https://developer.github.com/v3/orgs/teams/#list-user-teams
	 * @return string
	 * @throws \Exception
	 */
	public function lisUserTeams() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/teams')
		);
	}
}