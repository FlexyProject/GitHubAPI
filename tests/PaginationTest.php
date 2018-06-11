<?php

namespace FlexyProject\GitHub\Tests;

use FlexyProject\GitHub\Client;
use FlexyProject\GitHub\Pagination;
use FlexyProject\GitHub\Receiver\Activity;

/**
 * Class PaginationTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class PaginationTest extends AbstractClientTest
{

    /** @var Pagination */
    protected $pagination;

    public function setUp()
    {
        $this->pagination = new Pagination();
        $this->client->setPagination($this->pagination);
    }

    public function testInstanceOf()
    {
        self::assertInstanceOf(Pagination::class, $this->pagination);
    }

    public function testPage()
    {
        $this->pagination->setLimit(10);
        $this->pagination->setPage(2);
        self::assertEquals(2, $this->pagination->getPage());

        $activity = $this->client->getReceiver(Client::ACTIVITY);
        $events   = $activity->getReceiver(Activity::EVENTS);
        self::assertCount(10, $events->listPublicEvents());
    }

    public function testLimit()
    {
        $this->pagination->setLimit(10);
        self::assertEquals(10, $this->pagination->getLimit());

        $activity = $this->client->getReceiver(Client::ACTIVITY);
        $events   = $activity->getReceiver(Activity::EVENTS);
        self::assertCount(10, $events->listPublicEvents());
    }
}
