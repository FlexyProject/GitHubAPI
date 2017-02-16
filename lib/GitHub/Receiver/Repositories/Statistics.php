<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

/**
 * The Statistics API class provides access to repository's statistics.
 *
 * @link    https://developer.github.com/v3/repos/statistics/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Statistics extends AbstractRepositories
{

    /**
     * Get contributors list with additions, deletions, and commit counts
     *
     * @link https://developer.github.com/v3/repos/statistics/#contributors
     * @return array
     */
    public function listContributors(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/stats/contributors',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()));
    }

    /**
     * Get the last year of commit activity data
     *
     * @link https://developer.github.com/v3/repos/statistics/#commit-activity
     * @return array
     */
    public function getCommitActivity(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/stats/commit_activity',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()));
    }

    /**
     * Get the number of additions and deletions per week
     *
     * @link https://developer.github.com/v3/repos/statistics/#code-frequency
     * @return array
     */
    public function getCodeFrequency(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/stats/code_frequency',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()));
    }

    /**
     * Get the weekly commit count for the repository owner and everyone else
     *
     * @link https://developer.github.com/v3/repos/statistics/#participation
     * @return array
     */
    public function getParticipation(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/stats/participation',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()));
    }

    /**
     * Get the number of commits per hour in each day
     *
     * @link https://developer.github.com/v3/repos/statistics/#punch-card
     * @return array
     */
    public function getPunchCard(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/stats/punch_card',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()));
    }
}