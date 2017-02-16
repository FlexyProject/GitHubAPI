<?php
namespace FlexyProject\GitHub\Receiver\Issues;

/**
 * The Trees API class provides access to Issues's events.
 *
 * @link    https://developer.github.com/v3/issues/events/
 * @package FlexyProject\GitHub\Receiver\Issues
 */
class Events extends AbstractIssues
{

    /**
     * List events for an issue
     *
     * @link https://developer.github.com/v3/issues/events/#list-events-for-an-issue
     *
     * @param int $issueNumber
     *
     * @return array
     */
    public function listIssueEvents(int $issueNumber): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/issues/:issue_number/events',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $issueNumber));
    }

    /**
     * List events for a repository
     *
     * @link https://developer.github.com/v3/issues/events/#list-events-for-a-repository
     * @return array
     */
    public function listRepositoryEvents(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/issues/events',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo()));
    }

    /**
     * Get a single event
     *
     * @link https://developer.github.com/v3/issues/events/#get-a-single-event
     *
     * @param int $id
     *
     * @return array
     */
    public function getEvent(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/issues/events/:id',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id));
    }
} 