<?php
namespace GitHub\Receiver;

use Http\Request;
use GitHub\AbstractApi;

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

	/**
	 * List repositories for the authenticated user.
	 * @see https://developer.github.com/v3/repos/#list-your-repositories
	 * @param string $type
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listYourRepositories($type = AbstractApi::TYPE_ALL, $sort = AbstractApi::SORT_FULL_NAME, $direction = AbstractApi::DIRECTION_DESC) {
		return $this->api->request(
			sprintf('/user/repos?%s', http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction]))
		);
	}

	/**
	 * List public repositories for the specified user.
	 * @see https://developer.github.com/v3/repos/#list-user-repositories
	 * @param string $username
	 * @param string $type
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listUserRepositories($username, $type = AbstractApi::TYPE_OWNER, $sort = AbstractApi::SORT_FULL_NAME, $direction = AbstractApi::DIRECTION_DESC) {
		return $this->api->request(
			sprintf('/users/%s/repos?%s', $username, http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction]))
		);
	}

	/**
	 * List repositories for the specified org.
	 * @see https://developer.github.com/v3/repos/#list-organization-repositories
	 * @param string $organization
	 * @param string $type
	 * @return mixed
	 */
	public function listOrganizationRepositories($organization, $type = AbstractApi::TYPE_ALL) {
		return $this->api->request(
			sprintf('/orgs/%s/repos?%', $organization, http_build_query(['type' => $type]))
		);
	}

	/**
	 * List all public repositories
	 * @see https://developer.github.com/v3/repos/#list-all-public-repositories
	 * @param string $since
	 * @return mixed
	 */
	public function listPublicRepositories($since = '') {
		return $this->api->request(
			sprintf('/repositories?%s', http_build_query(['since', $since]))
		);
	}

	/**
	 * Create a new repository for the authenticated user.
	 * @see https://developer.github.com/v3/repos/#create
	 * @param string $name
	 * @param string $description
	 * @param string $homepage
	 * @param bool   $private
	 * @param bool   $hasIssues
	 * @param bool   $hasWiki
	 * @param bool   $hasDownloads
	 * @param int    $teamId
	 * @param bool   $autoInit
	 * @param string $gitignoreTemplate
	 * @param string $licenseTemplate
	 * @return mixed
	 */
	public function createRepository($name, $description = '', $homepage = '', $private = false, $hasIssues = true, $hasWiki = true, $hasDownloads = true, $teamId = 0, $autoInit = false, $gitignoreTemplate = '', $licenseTemplate = '') {
		return $this->api->request(
			sprintf('/user/repos'),
			Request::METHOD_POST,
			[
				'name'               => $name,
				'description'        => $description,
				'homepage'           => $homepage,
				'private'            => $private,
				'has_issues'         => $hasIssues,
				'has_wiki'           => $hasWiki,
				'has_downloads'      => $hasDownloads,
				'team_id'            => $teamId,
				'auto_init'          => $autoInit,
				'gitignore_template' => $gitignoreTemplate,
				'license_template'   => $licenseTemplate
			]
		);
	}

	/**
	 * Create a new repository in this organization. The authenticated user must be a member of the specified organization.
	 * @see https://developer.github.com/v3/repos/#create
	 * @param string $organization
	 * @param string $name
	 * @param string $description
	 * @param string $homepage
	 * @param bool   $private
	 * @param bool   $hasIssues
	 * @param bool   $hasWiki
	 * @param bool   $hasDownloads
	 * @param int    $teamId
	 * @param bool   $autoInit
	 * @param string $gitignoreTemplate
	 * @param string $licenseTemplate
	 * @return mixed
	 */
	public function createOrganizationRepository($organization, $name, $description = '', $homepage = '', $private = false, $hasIssues = true, $hasWiki = true, $hasDownloads = true, $teamId = 0, $autoInit = false, $gitignoreTemplate = '', $licenseTemplate = '') {
		return $this->api->request(
			sprintf('/orgs/%s/repos?%s', $organization),
			Request::METHOD_POST,
			[
				'name'               => $name,
				'description'        => $description,
				'homepage'           => $homepage,
				'private'            => $private,
				'has_issues'         => $hasIssues,
				'has_wiki'           => $hasWiki,
				'has_downloads'      => $hasDownloads,
				'team_id'            => $teamId,
				'auto_init'          => $autoInit,
				'gitignore_template' => $gitignoreTemplate,
				'license_template'   => $licenseTemplate
			]
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
	 * @param string $name
	 * @param string $description
	 * @param string $homepage
	 * @param bool   $private
	 * @param bool   $hasIssues
	 * @param bool   $hasWiki
	 * @param bool   $hasDownloads
	 * @param string $defaultBranch
	 * @return mixed
	 */
	public function edit($name, $description = '', $homepage = '', $private = false, $hasIssues = true, $hasWiki = true, $hasDownloads = true, $defaultBranch = '') {
		return $this->api->request(
			sprintf('/repos/%s/%s', $this->getOwner(), $this->getRepo(), http_build_query([
				'name'           => $name,
				'description'    => $description,
				'homepage'       => $homepage,
				'private'        => $private,
				'has_issues'     => $hasIssues,
				'has_wiki'       => $hasWiki,
				'has_downloads'  => $hasDownloads,
				'default_branch' => $defaultBranch
			])),
			Request::METHOD_PATCH
		);
	}

	/**
	 * List contributors
	 * @see https://developer.github.com/v3/repos/#list-contributors
	 * @param string $anon
	 * @return mixed
	 */
	public function listContributors($anon = '0') {
		return $this->api->request(
			sprintf('/repos/%s/%s/contributors?%s', $this->getOwner(), $this->getRepo(), http_build_query(['anon' => $anon]))
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