<?php
namespace FlexyProject\GitHub\Receiver\Users;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Users;

/**
 * Class AbstractUsers
 *
 * @package FlexyProject\GitHub\Receiver\Users
 */
abstract class AbstractUsers
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $users;

    /**
     * Constructor
     *
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->setUsers($users);
        $this->setApi($users->getApi());
    }

    /**
     * Get users
     *
     * @return Users
     */
    public function getUsers(): Users
    {
        return $this->users;
    }

    /**
     * Set users
     *
     * @param Users $users
     *
     * @return AbstractUsers
     */
    public function setUsers(Users $users): AbstractUsers
    {
        $this->users = $users;

        return $this;
    }
}