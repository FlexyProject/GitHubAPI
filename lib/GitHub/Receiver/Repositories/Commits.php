<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;

/**
 * The Commits API class provides access to repository's commits.
 *
 * @link    https://developer.github.com/v3/repos/commits/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Commits extends AbstractRepositories
{

    /**
     * List commits on a repository
     *
     * @link https://developer.github.com/v3/repos/commits/#list-commits-on-a-repository
     *
     * @param string      $sha
     * @param string|null $path
     * @param string|null $author
     * @param string|null $since
     * @param string|null $until
     *
     * @return array
     */
    public function listCommits(string $sha = AbstractApi::BRANCH_MASTER, string $path = null, string $author = null,
                                string $since = null, string $until = null, $page = null, $per_page = null): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/commits?:args',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), http_build_query([
                "sha"    => $sha,
                "path"   => $path,
                "author" => $author,
                "since"  => $since,
                "until"  => $until,
				"page"   => $page,
				"per_page"  => $per_page
            ])));
    }

    /**
     * Get a single commit
     *
     * @link https://developer.github.com/v3/repos/commits/#get-a-single-commit
     *
     * @param string $sha
     *
     * @return array
     */
    public function getSingleCommit(string $sha): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/commits/:sha',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha));
    }

    /**
     * Compare two commits
     *
     * @link https://developer.github.com/v3/repos/commits/#compare-two-commits
     *
     * @param string $base
     * @param string $head
     *
     * @return array
     */
    public function compareTwoCommits(string $base, string $head): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/compare/:base...:head',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $base, $head));
    }
} 
