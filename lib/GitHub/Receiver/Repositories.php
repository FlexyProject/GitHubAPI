<?php
namespace FlexyProject\GitHub\Receiver;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class give you access to the Repository API.
 *
 * @link    https://developer.github.com/v3/repos/
 * @package FlexyProject\GitHub\Receiver
 */
class Repositories extends AbstractReceiver
{

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
     *
     * @link https://developer.github.com/v3/repos/#list-your-repositories
     *
     * @param string $type
     * @param string $sort
     * @param string $direction
     *
     * @return array
     */
    public function listYourRepositories(string $type = AbstractApi::TYPE_ALL,
                                         string $sort = AbstractApi::SORT_FULL_NAME,
                                         string $direction = AbstractApi::DIRECTION_DESC): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/repos?:args',
            http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction])));
    }

    /**
     * List public repositories for the specified user.
     *
     * @link https://developer.github.com/v3/repos/#list-user-repositories
     *
     * @param string $username
     * @param string $type
     * @param string $sort
     * @param string $direction
     *
     * @return array
     */
    public function listUserRepositories(string $username, string $type = AbstractApi::TYPE_OWNER,
                                         string $sort = AbstractApi::SORT_FULL_NAME,
                                         string $direction = AbstractApi::DIRECTION_DESC): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/repos?:args', $username,
            http_build_query(['type' => $type, 'sort' => $sort, 'direction' => $direction])));
    }

    /**
     * List repositories for the specified org.
     *
     * @link https://developer.github.com/v3/repos/#list-organization-repositories
     *
     * @param string $organization
     * @param string $type
     *
     * @return array
     */
    public function listOrganizationRepositories(string $organization, string $type = AbstractApi::TYPE_ALL): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/repos?:args', $organization,
            http_build_query(['type' => $type])));
    }

    /**
     * List all public repositories
     *
     * @link https://developer.github.com/v3/repos/#list-all-public-repositories
     *
     * @param string $since
     *
     * @return array
     */
    public function listPublicRepositories(string $since = '1970-01-01'): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repositories?:arg', http_build_query(['since', $since])));
    }

    /**
     * Create a new repository for the authenticated user.
     *
     * @link https://developer.github.com/v3/repos/#create
     *
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
     *
     * @return array
     */
    public function createRepository(string $name, string $description = '', string $homepage = '',
                                     bool $private = false, bool $hasIssues = true, bool $hasWiki = true,
                                     bool $hasDownloads = true, int $teamId = 0, bool $autoInit = false,
                                     string $gitignoreTemplate = '', string $licenseTemplate = ''): array
    {
        return $this->getApi()->request(sprintf('/user/repos'), Request::METHOD_POST, [
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
            ]);
    }

    /**
     * Create a new repository in this organization. The authenticated user must be a member of the specified
     * organization.
     *
     * @link https://developer.github.com/v3/repos/#create
     *
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
     *
     * @return array
     */
    public function createOrganizationRepository(string $organization, string $name, string $description = '',
                                                 string $homepage = '', bool $private = false, bool $hasIssues = true,
                                                 bool $hasWiki = true, bool $hasDownloads = true, int $teamId = 0,
                                                 bool $autoInit = false, string $gitignoreTemplate = '',
                                                 string $licenseTemplate = ''): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/repos', $organization),
            Request::METHOD_POST, [
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
            ]);
    }

    /**
     * Get
     *
     * @link https://developer.github.com/v3/repos/#get
     * @return array
     */
    public function get(): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo()));
    }

    /**
     * Edit
     *
     * @link https://developer.github.com/v3/repos/#edit
     *
     * @param string $name
     * @param string $description
     * @param string $homepage
     * @param bool   $private
     * @param bool   $hasIssues
     * @param bool   $hasWiki
     * @param bool   $hasDownloads
     * @param string $defaultBranch
     *
     * @return array
     */
    public function edit(string $name, string $description = '', string $homepage = '', bool $private = false,
                         bool $hasIssues = true, bool $hasWiki = true, bool $hasDownloads = true,
                         string $defaultBranch = ''): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo()),
            Request::METHOD_PATCH, [
                'name'           => $name,
                'description'    => $description,
                'homepage'       => $homepage,
                'private'        => $private,
                'has_issues'     => $hasIssues,
                'has_wiki'       => $hasWiki,
                'has_downloads'  => $hasDownloads,
                'default_branch' => $defaultBranch
            ]);
    }

    /**
     * List contributors
     *
     * @link https://developer.github.com/v3/repos/#list-contributors
     *
     * @param string $anon
     *
     * @return array
     */
    public function listContributors(string $anon = '0'): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo/contributors?:args', $this->getOwner(),
                                                 $this->getRepo(), http_build_query(['anon' => $anon])));
    }

    /**
     * List languages
     *
     * @link https://developer.github.com/v3/repos/#list-languages
     * @return array
     */
    public function listLanguages(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/languages', $this->getOwner(),
            $this->getRepo()));
    }

    /**
     * List Teams
     *
     * @link https://developer.github.com/v3/repos/#list-teams
     * @return array
     */
    public function listTeams(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/teams', $this->getOwner(),
            $this->getRepo()));
    }

    /**
     * List Tags
     *
     * @link https://developer.github.com/v3/repos/#list-tags
     * @return array
     */
    public function listTags(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/tags', $this->getOwner(),
            $this->getRepo()));
    }

    /**
     * List Branches
     *
     * @link https://developer.github.com/v3/repos/#list-branches
     * @return array
     */
    public function listBranches(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/branches', $this->getOwner(),
            $this->getRepo()));
    }

    /**
     * Get Branch
     *
     * @link https://developer.github.com/v3/repos/#get-branch
     *
     * @param string $branch
     *
     * @return array
     */
    public function getBranch(string $branch): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo/branches/:branch', $this->getOwner(),
                                                 $this->getRepo(), $branch));
    }

    /**
     * Delete a Repository
     *
     * @link https://developer.github.com/v3/repos/#delete-a-repository
     * @return array
     */
    public function deleteRepository(): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo', $this->getOwner(), $this->getRepo()),
            Request::METHOD_DELETE);
    }

    /**
     * Get the contents of a repository's license
     *
     * @link https://developer.github.com/v3/licenses/#get-the-contents-of-a-repositorys-license
     * @return array
     */
    public function getRepositoryLicenseContent(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/license', $this->getOwner(),
            $this->getRepo()));
    }
}