<?php
namespace FlexyProject\GitHub\Receiver\Users;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Emails API class provide access to manage email addresses.
 *
 * @link    https://developer.github.com/v3/users/emails/
 * @package FlexyProject\GitHub\Receiver\Users
 */
class Emails extends AbstractUsers
{

    /**
     * List email addresses for a user
     *
     * @link https://developer.github.com/v3/users/emails/#list-email-addresses-for-a-user
     * @return array
     * @throws \Exception
     */
    public function listEmailAddresses(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/emails'));
    }

    /**
     * Add email address(es)
     *
     * @link https://developer.github.com/v3/users/emails/#add-email-addresses
     *
     * @param array $addresses
     *
     * @return array
     * @throws \Exception
     */
    public function addEmailAddress(array $addresses = []): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/emails'), Request::METHOD_POST, $addresses);
    }

    /**
     * Delete email address(es)
     *
     * @link https://developer.github.com/v3/users/emails/#delete-email-addresses
     *
     * @param array $addresses
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteEmailAddress(array $addresses = []): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/user/emails'), Request::METHOD_DELETE, $addresses);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
}
