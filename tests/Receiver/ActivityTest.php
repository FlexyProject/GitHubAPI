<?php
namespace FlexyProject\GitHub\Tests\Receiver;

use FlexyProject\GitHub\Client;
use FlexyProject\GitHub\Receiver\Activity;
use FlexyProject\GitHub\Tests\AbstractClientTest;

/**
 * Class ActivityTest
 *
 * @package FlexyProject\GitHub\Tests\Receiver
 */
class ActivityTest extends AbstractClientTest
{
    /** @var Activity\Events */
    protected $events;

    /** @var Activity\Feeds */
    protected $feeds;

    /** @var Activity\Notifications */
    protected $notifications;

    /** @var Activity\Starring */
    protected $starring;

    /** @var Activity\Watching */
    protected $watching;

    /**
     * ActivityTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Activity
        $activity = $this->client->getReceiver(Client::ACTIVITY);
        $activity->setRepo('GitHubAPI');
        $activity->setOwner('FlexyProject');

        // Events
        $this->events = $activity->getReceiver(Activity::EVENTS);

        // Feeds
        $this->feeds = $activity->getReceiver(Activity::FEEDS);

        // Notifications
        $this->notifications = $activity->getReceiver(Activity::NOTIFICATIONS);

        // Starring
        $this->starring = $activity->getReceiver(Activity::STARRING);

        // Watching
        $this->watching = $activity->getReceiver(Activity::WATCHING);
    }

    /**
     * Test instance of Events's class
     */
    public function testEvents()
    {
        $this->assertInstanceOf(Activity\Events::class, $this->events);
    }

    /**
     * Test instance of Feeds's class
     */
    public function testFeeds()
    {
        $this->assertInstanceOf(Activity\Feeds::class, $this->feeds);
    }

    /**
     * Test instance of Notifications's class
     */
    public function testNotifications()
    {
        $this->assertInstanceOf(Activity\Notifications::class, $this->notifications);
    }

    /**
     * Test instance of Starring's class
     */
    public function testStarring()
    {
        $this->assertInstanceOf(Activity\Starring::class, $this->starring);
    }

    /**
     * Test instance of Watching's class
     */
    public function testWatching()
    {
        $this->assertInstanceOf(Activity\Watching::class, $this->watching);
    }

    /**
     * Test listing public events
     */
    public function testListPublicEvents()
    {
        $events = $this->events->listPublicEvents();
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
        }
    }

    /**
     * Test listing repository events
     */
    public function testListRepositoryEvents()
    {
        $events = $this->events->listRepositoryEvents();
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }

    /**
     * Test listing issues events
     */
    public function testListIssueEvents()
    {
        $events = $this->events->listIssueEvents();
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('url', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('event', $event);
            $this->assertArrayHasKey('issue', $event);
            $this->assertArrayHasKey('created_at', $event);
        }
    }

    /**
     * Test listing public network events
     */
    public function testListPublicNetworkEvents()
    {
        $events = $this->events->listPublicNetworkEvents();
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }

    /**
     * Test listing public organization events
     */
    public function testListPublicOrganizationEvents()
    {
        $events = $this->events->listPublicOrganizationEvents($GLOBALS['ORGANIZATION']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }

    /**
     * Test listing user receive events
     */
    public function testListUserReceiveEvents()
    {
        $events = $this->events->listUserReceiveEvents($GLOBALS['USERNAME']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
        }
    }

    /**
     * Test listing public user receive events
     */
    public function testListPublicUserReceiveEvents()
    {
        $events = $this->events->listPublicUserReceiveEvents($GLOBALS['USERNAME']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
        }
    }

    /**
     * Test listing user preformed events
     */
    public function testListUserPerformedEvents()
    {
        $events = $this->events->listUserPerformedEvents($GLOBALS['USERNAME']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }

    /**
     * Test listing public user performed events
     */
    public function testListPublicUserPerformedEvents()
    {
        $events = $this->events->listPublicUserPerformedEvents($GLOBALS['USERNAME']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }

    /**
     * Test listing organization events
     */
    public function testListOrganizationEvents()
    {
        $events = $this->events->listOrganizationEvents($GLOBALS['USERNAME'], $GLOBALS['ORGANIZATION']);
        if (!empty($events)) {
            $event = array_pop($events);

            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('type', $event);
            $this->assertArrayHasKey('actor', $event);
            $this->assertArrayHasKey('repo', $event);
            $this->assertArrayHasKey('payload', $event);
            $this->assertArrayHasKey('public', $event);
            $this->assertArrayHasKey('created_at', $event);
            $this->assertArrayHasKey('org', $event);
        }
    }
}