<?php
namespace Scion\Services\GitHub\Receiver;

use Scion\Http\Request;
use Scion\Services\GitHub\AbstractApi;

class Repositories extends AbstractReceiver {

	/** Available sub-Receiver */
	const COLLABORATORS = 'Collaborators';
	const COMMENTS      = 'Comments';
	const COMMITS       = 'Commits';
	const CONTENTS      = 'Contents';
	const DEPLOY_KEYS   = 'DeployKeys';
	const DEPLOYMENTS   = 'Deployments';
	const FORKS         = 'Forks';
	const HOOKS         = 'Hooks';
	const MERGING       = 'Merging';
	const PAGES         = 'Pages';
	const RELEASES      = 'Releases';
	const STATISTICS    = 'Statistics';
	const STATUSES      = 'Statuses';

	/** Available types */
	const TYPE_ALL     = 'all';
	const TYPE_OWNER   = 'owner';
	const TYPE_PUBLIC  = 'public';
	const TYPE_PRIVATE = 'private';
	const TYPE_MEMBER  = 'member';

	/** Available sort */
	const SORT_CREATED   = 'created';
	const SORT_UPDATED   = 'updated';
	const SORT_PUSHED    = 'pushed';
	const SORT_FULL_NAME = 'full_name';

	/** Available direction */
	const DIRECTION_ASC  = 'asc';
	const DIRECTION_DESC = 'desc';

	/**
	 * List repositories for the authenticated user.
	 * @see https://developer.github.com/v3/repos/#list-your-repositories
	 * @param string $type
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listYourRepositories($type = self::TYPE_ALL, $sort = self::SORT_FULL_NAME, $direction = self::DIRECTION_DESC) {
		return $this->api->request(sprintf('/user/repos?type=%s&sort=%s&direction=%s', $type, $sort, $direction));
	}

	/**
	 * List public repositories for the specified user.
	 * @see https://developer.github.com/v3/repos/#list-user-repositories
	 * @param string $username
	 * @return mixed
	 */
	public function listUserRepositories($username) {
		return $this->api->request(sprintf('/users/%s/repos', $username));
	}

	/**
	 * List repositories for the specified org.
	 * @see https://developer.github.com/v3/repos/#list-organization-repositories
	 * @param string $organization
	 * @return mixed
	 */
	public function listOrganizationRepositories($organization) {
		return $this->api->request(sprintf('/orgs/%s/repos', $organization));
	}

	/**
	 * List all public repositories
	 * @see https://developer.github.com/v3/repos/#list-all-public-repositories
	 * @return mixed
	 */
	public function listPublicRepositories() {
		return $this->api->request(sprintf('/repositories'));
	}

	/**
	 * Create a new repository for the authenticated user.
	 * @see https://developer.github.com/v3/repos/#create
	 * @return mixed
	 */
	public function createRepository() {
		return $this->api->request(
			sprintf('/user/repos'),
			Request::METHOD_POST
		);
	}

	/**
	 * Create a new repository in this organization. The authenticated user must be a member of the specified organization.
	 * @see https://developer.github.com/v3/repos/#create
	 * @param $organization
	 * @return mixed
	 */
	public function createOrganizationRepository($organization) {
		return $this->api->request(
			sprintf('/orgs/%s/repos', $organization),
			Request::METHOD_POST
		);
	}

	/**
	 * Get
	 * @see https://developer.github.com/v3/repos/#get
	 * @return mixed
	 */
	public function get() {
		return $this->api->request(
			sprintf('/repos/%s/%s', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * Edit
	 * @see https://developer.github.com/v3/repos/#edit
	 * @return mixed
	 */
	public function edit() {
		return $this->api->request(
			sprintf('/repos/%s/%s', $this->getOwner(), $this->getRepo()),
			Request::METHOD_PATCH
		);
	}

	/**
	 * List contributors
	 * @see https://developer.github.com/v3/repos/#list-contributors
	 * @return mixed
	 */
	public function listContributors() {
		return $this->api->request(
			sprintf('/repos/%s/%s/contributors', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List languages
	 * @see https://developer.github.com/v3/repos/#list-languages
	 * @return mixed
	 */
	public function listLanguages() {
		return $this->api->request(
			sprintf('/repos/%s/%s/languages', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Teams
	 * @see https://developer.github.com/v3/repos/#list-teams
	 * @return mixed
	 */
	public function listTeams() {
		return $this->api->request(
			sprintf('/repos/%s/%s/teams', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Tags
	 * @see https://developer.github.com/v3/repos/#list-tags
	 * @return mixed
	 */
	public function listTags() {
		return $this->api->request(
			sprintf('/repos/%s/%s/tags', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Branches
	 * @see https://developer.github.com/v3/repos/#list-branches
	 * @return mixed
	 */
	public function listBranches() {
		return $this->api->request(
			sprintf('/repos/%s/%s/branches', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * Get Branch
	 * @see https://developer.github.com/v3/repos/#get-branch
	 * @param string $branch
	 * @return mixed
	 */
	public function getBranch($branch) {
		return $this->api->request(
			sprintf('/repos/%s/%s/branches/%s', $this->getOwner(), $this->getRepo(), $branch)
		);
	}

	/**
	 * Delete a Repository
	 * @see https://developer.github.com/v3/repos/#delete-a-repository
	 * @return mixed
	 */
	public function deleteRepository() {
		return $this->api->request(
			sprintf('/repos/%s/%s', $this->getOwner(), $this->getRepo()),
			Request::METHOD_DELETE
		);
	}
}