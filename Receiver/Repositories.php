<?php
namespace Scion\GitHub\Receiver;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;

/**
 * Repositories API class
 * @link    https://developer.github.com/v3/repos/
 * @package Scion\GitHub\Receiver
 */
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
	 * @link https://developer.github.com/v3/repos/#list-your-repositories
	 * @param string $type
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listYourRepositories($type = AbstractApi::TYPE_ALL, $sort = AbstractApi::SORT_FULL_NAME, $direction = AbstractApi::DIRECTION_DESC) {
		return $this->getApi()->request(
			sprintf('/user/repos?%s', http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction]))
		);
	}

	/**
	 * List public repositories for the specified user.
	 * @link https://developer.github.com/v3/repos/#list-user-repositories
	 * @param string $username
	 * @param string $type
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listUserRepositories($username, $type = AbstractApi::TYPE_OWNER, $sort = AbstractApi::SORT_FULL_NAME, $direction = AbstractApi::DIRECTION_DESC) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/repos?:args', $username, http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction]))
		);
	}

	/**
	 * List repositories for the specified org.
	 * @link https://developer.github.com/v3/repos/#list-organization-repositories
	 * @param string $organization
	 * @param string $type
	 * @return mixed
	 */
	public function listOrganizationRepositories($organization, $type = AbstractApi::TYPE_ALL) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/repos?:args', $organization, http_build_query(['type' => $type]))
		);
	}

	/**
	 * List all public repositories
	 * @link https://developer.github.com/v3/repos/#list-all-public-repositories
	 * @param string $since
	 * @return mixed
	 */
	public function listPublicRepositories($since = '') {
		return $this->getApi()->request(
			sprintf('/repositories?%s', http_build_query(['since', $since]))
		);
	}

	/**
	 * Create a new repository for the authenticated user.
	 * @link https://developer.github.com/v3/repos/#create
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
		return $this->getApi()->request(
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
	 * @link https://developer.github.com/v3/repos/#create
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
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/repos', $organization),
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
	 * @link https://developer.github.com/v3/repos/#get
	 * @return mixed
	 */
	public function get() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * Edit
	 * @link https://developer.github.com/v3/repos/#edit
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
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo()),
			Request::METHOD_PATCH,
			[
				'name'           => $name,
				'description'    => $description,
				'homepage'       => $homepage,
				'private'        => $private,
				'has_issues'     => $hasIssues,
				'has_wiki'       => $hasWiki,
				'has_downloads'  => $hasDownloads,
				'default_branch' => $defaultBranch
			]
		);
	}

	/**
	 * List contributors
	 * @link https://developer.github.com/v3/repos/#list-contributors
	 * @param string $anon
	 * @return mixed
	 */
	public function listContributors($anon = '0') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/contributors?:args', $this->getOwner(), $this->getRepo(), http_build_query(['anon' => $anon]))
		);
	}

	/**
	 * List languages
	 * @link https://developer.github.com/v3/repos/#list-languages
	 * @return mixed
	 */
	public function listLanguages() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/languages', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Teams
	 * @link https://developer.github.com/v3/repos/#list-teams
	 * @return mixed
	 */
	public function listTeams() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/teams', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Tags
	 * @link https://developer.github.com/v3/repos/#list-tags
	 * @return mixed
	 */
	public function listTags() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/tags', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * List Branches
	 * @link https://developer.github.com/v3/repos/#list-branches
	 * @return mixed
	 */
	public function listBranches() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/branches', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * Get Branch
	 * @link https://developer.github.com/v3/repos/#get-branch
	 * @param string $branch
	 * @return mixed
	 */
	public function getBranch($branch) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/branches/:branch', $this->getOwner(), $this->getRepo(), $branch)
		);
	}

	/**
	 * Delete a Repository
	 * @link https://developer.github.com/v3/repos/#delete-a-repository
	 * @return mixed
	 */
	public function deleteRepository() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo()),
			Request::METHOD_DELETE
		);
	}
}