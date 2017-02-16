<?php
namespace FlexyProject\GitHub\Receiver\GitData;

use DateTime;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Commits API class provides access to GitData's commits.
 *
 * @link    https://developer.github.com/v3/git/commits/
 * @package FlexyProject\GitHub\Receiver\GitData
 */
class Commits extends AbstractGitData
{

    /**
     * Get a Commit
     *
     * @link https://developer.github.com/v3/git/commits/#get-a-commit
     *
     * @param string $sha
     *
     * @return array
     */
    public function get(string $sha): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/git/commits/:sha',
            $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $sha));
    }

    /**
     * Create a Commit
     *
     * @link https://developer.github.com/v3/git/commits/#create-a-commit
     *
     * @param string       $message
     * @param string       $tree
     * @param array|string $parents
     * @param string       $name
     * @param string       $email
     * @param string       $date
     *
     * @return array
     * @throws \Exception
     */
    public function create(string $message, string $tree, $parents, string $name = null, string $email = null,
                           string $date = 'now'): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/git/commits',
            $this->getGitData()->getOwner(), $this->getGitData()->getRepo()), Request::METHOD_POST, [
                'message' => $message,
                'tree'    => $tree,
                'parents' => $parents,
                'name'    => $name,
                'email'   => $email,
                'date'    => (new DateTime($date))->format(DateTime::ATOM)
            ]);
    }
}