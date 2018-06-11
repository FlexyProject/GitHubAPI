<?php
namespace FlexyProject\GitHub\Receiver;

use Symfony\Component\HttpFoundation\Request;

/**
 * This class give you access to the organizations API.
 *
 * @link    https://developer.github.com/v3/orgs/
 * @package FlexyProject\GitHub\Receiver
 */
class Organizations extends AbstractReceiver
{

    /** Available sub-Receiver */
    const MEMBERS = 'Members';
    const TEAMS   = 'Teams';
    const HOOKS   = 'Hooks';

    /**
     * List your organizations
     *
     * @link https://developer.github.com/v3/orgs/#list-your-organizations
     * @return array
     * @throws \Exception
     */
    public function listOrganizations(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/orgs'));
    }

    /**
     * List user organizations
     *
     * @link https://developer.github.com/v3/orgs/#list-user-organizations
     *
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function listUserOrganizations(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/orgs', $username));
    }

    /**
     * Get an organization
     *
     * @link https://developer.github.com/v3/orgs/#get-an-organization
     *
     * @param string $org
     *
     * @return array
     * @throws \Exception
     */
    public function get(string $org): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org', $org));
    }

    /**
     * Edit an organization
     *
     * @link https://developer.github.com/v3/orgs/#edit-an-organization
     *
     * @param string $org
     * @param string $billingEmail
     * @param string $company
     * @param string $email
     * @param string $location
     * @param string $name
     * @param string $description
     *
     * @return array
     * @throws \Exception
     */
    public function edit(
        string $org,
        string $billingEmail = null,
        string $company = null,
        string $email = null,
        string $location = null,
        string $name = null,
        string $description = null
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org', $org), Request::METHOD_PATCH, [
                'billing_email' => $billingEmail,
                'company'       => $company,
                'email'         => $email,
                'location'      => $location,
                'name'          => $name,
                'description'   => $description
            ]);
    }
}
