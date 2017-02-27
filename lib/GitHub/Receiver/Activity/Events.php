<?php
namespace FlexyProject\GitHub\Receiver\Activity;

/**
 * The Events API class provide a read-only interface to all the event types that power the various activity streams on
 * GitHub.
 *
 * @link    https://developer.github.com/v3/activity/events/
 * @package GitHub\Receiver\Activity
 */
class Events extends AbstractActivity
{

    /**
     * List public events
     *
     * @link https://developer.github.com/v3/activity/events/#list-public-events
     * @return array
     */
    public function listPublicEvents(): array
    {
        return $this->getApi()->request('/events');
    }

    /**
     * List repository events
     *
     * @link https://developer.github.com/v3/activity/events/#list-repository-events
     * @return array
     */
    public function listRepositoryEvents(): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo/events', $this->getActivity()->getOwner(),
                                                 $this->getActivity()->getRepo()));
    }

    /**
     * List issue events for a repository
     *
     * @link https://developer.github.com/v3/activity/events/#list-issue-events-for-a-repository
     * @return array
     */
    public function listIssueEvents(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/issues/events',
            $this->getActivity()->getOwner(), $this->getActivity()->getRepo()));
    }

    /**
     * List public events for a network of repositories
     *
     * @link https://developer.github.com/v3/activity/events/#list-public-events-for-a-network-of-repositories
     * @return array
     */
    public function listPublicNetworkEvents(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/networks/:owner/:repo/events',
            $this->getActivity()->getOwner(), $this->getActivity()->getRepo()));
    }

    /**
     * List public events for an organization
     *
     * @link https://developer.github.com/v3/activity/events/#list-public-events-for-an-organization
     *
     * @param string $organization
     *
     * @return array
     */
    public function listPublicOrganizationEvents(string $organization): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/events', $organization));
    }

    /**
     * List events that a user has received
     *
     * @link https://developer.github.com/v3/activity/events/#list-events-that-a-user-has-received
     *
     * @param string $username
     *
     * @return array
     */
    public function listUserReceiveEvents(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/received_events', $username));
    }

    /**
     * List public events that a user has received
     *
     * @link https://developer.github.com/v3/activity/events/#list-public-events-that-a-user-has-received
     *
     * @param string $username
     *
     * @return array
     */
    public function listPublicUserReceiveEvents(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/received_events/public', $username));
    }

    /**
     * List events performed by a user
     *
     * @link https://developer.github.com/v3/activity/events/#list-events-performed-by-a-user
     *
     * @param string $username
     *
     * @return array
     */
    public function listUserPerformedEvents(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/events', $username));
    }

    /**
     * List public events performed by a user
     *
     * @link https://developer.github.com/v3/activity/events/#list-public-events-performed-by-a-user
     *
     * @param string $username
     *
     * @return array
     */
    public function listPublicUserPerformedEvents(string $username): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/users/:username/events/public', $username));
    }

    /**
     * List events for an organization
     *
     * @link https://developer.github.com/v3/activity/events/#list-events-for-an-organization
     *
     * @param string $username
     * @param string $organization
     *
     * @return array
     */
    public function listOrganizationEvents(string $username, string $organization): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/users/:username/events/orgs/:org', $username, $organization));
    }
} 