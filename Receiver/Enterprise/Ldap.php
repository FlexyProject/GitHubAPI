<?php
namespace Scion\GitHub\Receiver\Enterprise;

use Scion\Http\Request;

/**
 * The LDAP API is used to update account relationships between a GitHub Enterprise user and its linked LDAP entry or queue a new synchronization.
 * @link    https://developer.github.com/v3/enterprise/ldap/
 * @since   2.2
 * @package Scion\GitHub\Receiver\Enterprise
 */
class Ldap extends AbstractEnterprise {

	/**
	 * Update LDAP mapping for a user
	 * @link https://developer.github.com/v3/enterprise/ldap/#update-ldap-mapping-for-a-user
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function updateMappingUser($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/admin/ldap/user/:username/mapping', $username),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Sync LDAP mapping for a user
	 * @link https://developer.github.com/v3/enterprise/ldap/#sync-ldap-mapping-for-a-user
	 * @param int $userId
	 * @return string
	 * @throws \Exception
	 */
	public function syncMappingUser($userId) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/admin/ldap/user/:user_id/sync', (string)$userId),
			Request::METHOD_POST
		);
	}

	/**
	 * Update LDAP mapping for a team
	 * @link https://developer.github.com/v3/enterprise/ldap/#update-ldap-mapping-for-a-team
	 * @param int $teamId
	 * @return string
	 * @throws \Exception
	 */
	public function updateMappingTeam($teamId) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/admin/ldap/teams/:team_id/mapping', (String)$teamId),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Sync LDAP mapping for a team
	 * @link https://developer.github.com/v3/enterprise/ldap/#sync-ldap-mapping-for-a-team
	 * @param int $teamId
	 * @return string
	 * @throws \Exception
	 */
	public function syncMappingTeam($teamId) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/admin/ldap/teams/:team_id/sync', (string)$teamId),
			Request::METHOD_POST
		);
	}
}