<?php
namespace FlexyProject\GitHub\Receiver\Users;

use Symfony\Component\HttpFoundation\Request;

/**
 * The PublicKeys API class provide access to manage public keys.
 *
 * @link    https://developer.github.com/v3/users/keys/
 * @package FlexyProject\GitHub\Receiver\Users
 */
class PublicKeys extends AbstractUsers
{

    /**
     * List public keys for a user
     *
     * @link https://developer.github.com/v3/users/keys/#list-public-keys-for-a-user
     *
     * @param string $username
     *
     * @return array
     * @throws \Exception
     */
    public function listUserPublicKeys(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/keys', $username));
    }

    /**
     * List your public keys
     *
     * @link https://developer.github.com/v3/users/keys/#list-your-public-keys
     * @return array
     * @throws \Exception
     */
    public function listYourPublicKeys(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/keys'));
    }

    /**
     * Get a single public key
     *
     * @link https://developer.github.com/v3/users/keys/#get-a-single-public-key
     *
     * @param int $id
     *
     * @return array
     * @throws \Exception
     */
    public function getSinglePublicKey(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/keys/:id', (string)$id));
    }

    /**
     * Create a public key
     *
     * @link https://developer.github.com/v3/users/keys/#create-a-public-key
     * @return array
     * @throws \Exception
     */
    public function createPublicKey(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/user/keys'), Request::METHOD_POST);
    }

    /**
     * Delete a public key
     *
     * @link https://developer.github.com/v3/users/keys/#delete-a-public-key
     *
     * @param int $id
     *
     * @return array
     * @throws \Exception
     */
    public function deletePublicKey(int $id): array
    {
        return $this->getApi()->request(
            $this->getApi()->sprintf('/user/keys/:id', (string)$id),
            Request::METHOD_DELETE
        );
    }
}
