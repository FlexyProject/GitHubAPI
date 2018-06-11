<?php
namespace FlexyProject\GitHub\Receiver\Organizations;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * Teams API class gives you access to the available organization's teams.
 *
 * @package FlexyProject\GitHub\Receiver\Organizations
 */
class Teams extends AbstractOrganizations
{

    /**
     * List teams
     *
     * @link https://developer.github.com/v3/orgs/teams/#list-teams
     *
     * @param string $org
     *
     * @return array
     * @throws \Exception
     */
    public function listTeams(string $org): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/teams', $org));
    }

    /**
     * Get team
     *
     * @link https://developer.github.com/v3/orgs/teams/#get-team
     *
     * @param int $id
     *
     * @return array
     * @throws \Exception
     */
    public function getTeam(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/teams/:id', (string)$id));
    }

    /**
     * Create team
     *
     * @link https://developer.github.com/v3/orgs/teams/#create-team
     *
     * @param string      $org
     * @param string      $name
     * @param null|string $description
     * @param array       $repoNames
     * @param string      $permission
     *
     * @return array
     * @throws \Exception
     */
    public function createTeam(
        string $org,
        string $name,
        string $description = null,
        array $repoNames = [],
        string $permission = AbstractApi::PERMISSION_PULL
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/teams', $org), Request::METHOD_POST, [
                'name'        => $name,
                'description' => $description,
                'repo_names'  => $repoNames,
                'permission'  => $permission
            ]);
    }

    /**
     * Edit team
     *
     * @link https://developer.github.com/v3/orgs/teams/#edit-team
     *
     * @param int         $id
     * @param string      $name
     * @param null|string $description
     * @param string      $permission
     *
     * @return array
     * @throws \Exception
     */
    public function editTeam(
        int $id,
        string $name,
        string $description = null,
        string $permission = AbstractApi::PERMISSION_PULL
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf('/teams/:id', (string)$id), Request::METHOD_PATCH, [
                'name'        => $name,
                'description' => $description,
                'permission'  => $permission
            ]);
    }

    /**
     * Delete team
     *
     * @link https://developer.github.com/v3/orgs/teams/#delete-team
     *
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteTeam(int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/teams/:id', (string)$id), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * List team members
     *
     * @link https://developer.github.com/v3/orgs/teams/#list-team-members
     *
     * @param int $id
     *
     * @return array
     * @throws \Exception
     */
    public function listTeamMembers(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/teams/:id/members', (string)$id));
    }

    /**
     * Get team membership
     *
     * @link https://developer.github.com/v3/orgs/teams/#get-team-membership
     *
     * @param int    $id
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function getTeamMembership(int $id, string $username): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/teams/:id/memberships/:username', (string)$id, $username));
    }

    /**
     * Add team membership
     *
     * @link https://developer.github.com/v3/orgs/teams/#add-team-membership
     *
     * @param int    $id
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function addTeamMembership(int $id, string $username): array
    {
        return $this->getApi()->request(
            $this->getApi()
                                             ->sprintf('/teams/:id/memberships/:username', (string)$id, $username),
            Request::METHOD_PUT
        );
    }

    /**
     * Remove team membership
     *
     * @link https://developer.github.com/v3/orgs/teams/#remove-team-membership
     *
     * @param int    $id
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function removeTeamMembership(int $id, string $username): bool
    {
        $this->getApi()->request(
            $this->getApi()->sprintf('/teams/:id/memberships/:username', (string)$id, $username),
            Request::METHOD_DELETE
        );

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * List team repos
     *
     * @link https://developer.github.com/v3/orgs/teams/#list-team-repos
     *
     * @param int $id
     *
     * @return array
     * @throws \Exception
     */
    public function listTeamRepos(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/teams/:id/repos', (string)$id));
    }

    /**
     * Check if a team manages a repository
     *
     * @link https://developer.github.com/v3/orgs/teams/#get-team-repo
     *
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public function checkTeamManagesRepository(int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf(
            '/teams/:id/repos/:owner/:repo',
            (string)$id,
            $this->getOrganizations()->getOwner(),
            $this->getOrganizations()->getRepo()
        ));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Add team repository
     *
     * @link https://developer.github.com/v3/orgs/teams/#add-team-repo
     *
     * @param int $id
     *
     * @return bool|array
     * @throws \Exception
     */
    public function addTeamRepository(int $id)
    {
        $return = $this->getApi()->request($this->getApi()->sprintf(
            '/teams/:id/repos/:org/:repo',
            (string)$id,
            $this->getOrganizations()->getOwner(),
            $this->getOrganizations()->getRepo()
        ), Request::METHOD_PUT);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return $return;
    }

    /**
     * Remove team repository
     *
     * @link https://developer.github.com/v3/orgs/teams/#remove-team-repo
     *
     * @param int $id
     *
     * @return bool
     * @throws \Exception
     */
    public function removeTeamRepository(int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf(
            '/teams/:id/repos/:owner/:repo',
            (string)$id,
            $this->getOrganizations()->getOwner(),
            $this->getOrganizations()->getRepo()
        ), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * List user teams
     *
     * @link https://developer.github.com/v3/orgs/teams/#list-user-teams
     * @return array
     * @throws \Exception
     */
    public function lisUserTeams(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/teams'));
    }
}
