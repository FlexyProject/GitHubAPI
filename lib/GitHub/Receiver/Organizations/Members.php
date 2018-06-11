<?php
namespace FlexyProject\GitHub\Receiver\Organizations;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * Members API class gives you access to the available organization's members.
 *
 * @package FlexyProject\GitHub\Receiver\Organizations
 */
class Members extends AbstractOrganizations
{

    /**
     * Members list
     *
     * @link https://developer.github.com/v3/orgs/members/#members-list
     *
     * @param string $org
     * @param string $filter
     * @param string $role
     *
     * @return array
     */
    public function listMembers(string $org, string $filter = AbstractApi::FILTER_ALL, string $role = 'admin'): array
    {
        $this->getApi()->setAccept('application/vnd.github.moondragon+json');

        return $this->getApi()->request($this->getApi()->sprintf(
            '/orgs/:org/members?:args',
            $org,
            http_build_query(['filter' => $filter, 'role' => $role])
        ));
    }

    /**
     * Check membership
     *
     * @link https://developer.github.com/v3/orgs/members/#check-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function checkMembership(string $org, string $username): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/members/:username', $org, $username));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Remove a member
     *
     * @link https://developer.github.com/v3/orgs/members/#remove-a-member
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function removeMember(string $org, string $username): bool
    {
        $this->getApi()->request(
            $this->getApi()->sprintf('/orgs/:org/members/:username', $org, $username),
            Request::METHOD_DELETE
        );

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Public members list
     *
     * @link https://developer.github.com/v3/orgs/members/#public-members-list
     *
     * @param string $org
     *
     * @return array
     * @throws \Exception
     */
    public function listPublicMembers(string $org): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/public_members', $org));
    }

    /**
     * Check public membership
     *
     * @link https://developer.github.com/v3/orgs/members/#check-public-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function checkPublicMembership(string $org, string $username): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/public_members/:username', $org, $username));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Publicize a user’s membership
     *
     * @link https://developer.github.com/v3/orgs/members/#publicize-a-users-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function publicizeUsersMembership(string $org, string $username): bool
    {
        $this->getApi()->request(
            $this->getApi()->sprintf('/orgs/:org/public_members/:username', $org, $username),
            Request::METHOD_PUT
        );

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Conceal a user’s membership
     *
     * @link https://developer.github.com/v3/orgs/members/#conceal-a-users-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function concealUsersMembership(string $org, string $username): bool
    {
        $this->getApi()->request(
            $this->getApi()->sprintf('/orgs/:org/public_members/:username', $org, $username),
            Request::METHOD_DELETE
        );

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Get organization membership
     *
     * @link https://developer.github.com/v3/orgs/members/#get-organization-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function getOrganizationMembership(string $org, string $username): array
    {
        $this->getApi()->setAccept('application/vnd.github.moondragon+json');

        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/memberships/:username', $org, $username));
    }

    /**
     * Add or update organization membership
     *
     * @link https://developer.github.com/v3/orgs/members/#add-or-update-organization-membership
     *
     * @param string $org
     * @param string $username
     * @param string $role
     *
     * @return array
     * @throws \Exception
     */
    public function addUpdateOrganizationMembership(string $org, string $username, string $role): array
    {
        $this->getApi()->setAccept('application/vnd.github.moondragon+json');

        return $this->getApi()->request($this->getApi()
                                             ->sprintf(
                                                 '/orgs/:org/memberships/:username?:args',
                                                 $org,
                                                 $username,
                                                 http_build_query(['role' => $role])
                                             ), Request::METHOD_PUT);
    }

    /**
     * Remove organization membership
     *
     * @link https://developer.github.com/v3/orgs/members/#remove-organization-membership
     *
     * @param string $org
     * @param string $username
     *
     * @return bool
     * @throws \Exception
     */
    public function removeOrganizationMembership(string $org, string $username): bool
    {
        $this->getApi()->setAccept('application/vnd.github.moondragon+json');

        $this->getApi()->request(
            $this->getApi()->sprintf('/orgs/:org/memberships/:username', $org, $username),
            Request::METHOD_DELETE
        );

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * List your organization memberships
     *
     * @link https://developer.github.com/v3/orgs/members/#list-your-organization-memberships
     *
     * @param string|null $state
     *
     * @return array
     * @throws \Exception
     */
    public function listYourOrganizationMembership(string $state = null): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/user/memberships/orgs?:args',
            http_build_query(['state' => $state])
        ));
    }

    /**
     * Get your organization membership
     *
     * @link https://developer.github.com/v3/orgs/members/#get-your-organization-membership
     *
     * @param string $org
     *
     * @return array
     * @throws \Exception
     */
    public function getYourOrganizationMembership(string $org): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/memberships/orgs/:org', $org));
    }

    /**
     * Edit your organization membership
     *
     * @link https://developer.github.com/v3/orgs/members/#edit-your-organization-membership
     *
     * @param string $org
     * @param string $state
     *
     * @return array
     * @throws \Exception
     */
    public function editYourOrganizationMembership(string $org, string $state = AbstractApi::STATE_ACTIVE): array
    {
        return $this->getApi()->request(
            $this->getApi()->sprintf('/user/memberships/orgs/:org', $org),
            Request::METHOD_PATCH,
            [
                'state' => $state
            ]
        );
    }
}
