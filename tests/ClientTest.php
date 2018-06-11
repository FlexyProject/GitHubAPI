<?php
namespace FlexyProject\GitHub\Tests;

use FlexyProject\GitHub\Client;
use FlexyProject\GitHub\Receiver\Activity;
use FlexyProject\GitHub\Receiver\Enterprise;
use FlexyProject\GitHub\Receiver\Gists;
use FlexyProject\GitHub\Receiver\GitData;
use FlexyProject\GitHub\Receiver\Issues;
use FlexyProject\GitHub\Receiver\Miscellaneous;
use FlexyProject\GitHub\Receiver\Organizations;
use FlexyProject\GitHub\Receiver\PullRequests;
use FlexyProject\GitHub\Receiver\Repositories;
use FlexyProject\GitHub\Receiver\Search;
use FlexyProject\GitHub\Receiver\Users;

/**
 * Class ClientTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class ClientTest extends AbstractClientTest
{

    /**
     * Test instance of Client's class
     */
    public function testClient()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    /**
     * Test instance of Activity's class
     */
    public function testActivityReceiver()
    {
        $this->assertInstanceOf(Activity::class, $this->client->getReceiver(Client::ACTIVITY));
    }

    /**
     * Test instance of Enterprise's class
     */
    public function testEnterpriseReceiver()
    {
        $this->assertInstanceOf(Enterprise::class, $this->client->getReceiver(Client::ENTERPRISE));
    }

    /**
     * Test instance of Gists's class
     */
    public function testGistsReceiver()
    {
        $this->assertInstanceOf(Gists::class, $this->client->getReceiver(Client::GISTS));
    }

    /**
     * Test instance of GitData's class
     */
    public function testGitDataReceiver()
    {
        $this->assertInstanceOf(GitData::class, $this->client->getReceiver(Client::GIT_DATA));
    }

    /**
     * Test instance of Issues's class
     */
    public function testIssuesReceiver()
    {
        $this->assertInstanceOf(Issues::class, $this->client->getReceiver(Client::ISSUES));
    }

    /**
     * Test instance of Miscellaneous's class
     */
    public function testMiscellaneousReceiver()
    {
        $this->assertInstanceOf(Miscellaneous::class, $this->client->getReceiver(Client::MISCELLANEOUS));
    }

    /**
     * Test instance of Organizations's class
     */
    public function testOrganizationsReceiver()
    {
        $this->assertInstanceOf(Organizations::class, $this->client->getReceiver(Client::ORGANIZATIONS));
    }

    /**
     * Test instance of PullRequests's class
     */
    public function testPullRequestsReceiver()
    {
        $this->assertInstanceOf(PullRequests::class, $this->client->getReceiver(Client::PULL_REQUESTS));
    }

    /**
     * Test instance of Repositories's class
     */
    public function testRepositoriesReceiver()
    {
        $this->assertInstanceOf(Repositories::class, $this->client->getReceiver(Client::REPOSITORIES));
    }

    /**
     * Test instance of Search's class
     */
    public function testSearchReceiver()
    {
        $this->assertInstanceOf(Search::class, $this->client->getReceiver(Client::SEARCH));
    }

    /**
     * Test instance of Users's class
     */
    public function testUsersReceiver()
    {
        $this->assertInstanceOf(Users::class, $this->client->getReceiver(Client::USERS));
    }
}
