<?php
namespace FlexyProject\GitHub\Receiver;

use Symfony\Component\HttpFoundation\Request;

/**
 * This class give you access to the Users API.
 *
 * @link    https://developer.github.com/v3/users/
 * @package FlexyProject\GitHub\Receiver
 */
class Users extends AbstractReceiver
{

    /** Available sub-Receiver */
    const EMAILS      = 'Emails';
    const FOLLOWERS   = 'Followers';
    const PUBLIC_KEYS = 'PublicKeys';

    /**
     * Get a single user
     *
     * @link https://developer.github.com/v3/users/#get-a-single-user
     *
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function getSingleUser(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username', $username));
    }

    /**
     * Get the authenticated user
     *
     * @link https://developer.github.com/v3/users/#get-the-authenticated-user
     * @return array
     * @throws \Exception
     */
    public function getUser(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user'));
    }

    /**
     * Update the authenticated user
     *
     * @link https://developer.github.com/v3/users/#update-the-authenticated-user
     *
     * @param string $name
     * @param string $email
     * @param string $blog
     * @param string $company
     * @param string $location
     * @param bool   $hireable
     * @param string $bio
     *
     * @return array
     * @throws \Exception
     */
    public function updateUser(
        string $name = null,
        string $email = null,
        string $blog = null,
        string $company = null,
        string $location = null,
        bool $hireable = false,
        string $bio = null
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf('/user'), Request::METHOD_PATCH, [
                'name'     => $name,
                'email'    => $email,
                'blog'     => $blog,
                'company'  => $company,
                'location' => $location,
                'hireable' => $hireable,
                'bio'      => $bio
            ]);
    }

    /**
     * Get all users
     *
     * @link https://developer.github.com/v3/users/#get-all-users
     *
     * @param string $since
     *
     * @return array
     * @throws \Exception
     */
    public function getAllUsers(string $since = null): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/users?:args', http_build_query(['since' => $since])));
    }
}
