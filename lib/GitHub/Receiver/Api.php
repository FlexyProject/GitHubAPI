<?php
namespace FlexyProject\GitHub\Receiver;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Activity\AbstractActivity;
use FlexyProject\GitHub\Receiver\Enterprise\AbstractEnterprise;
use FlexyProject\GitHub\Receiver\Gists\AbstractGists;
use FlexyProject\GitHub\Receiver\GitData\AbstractGitData;
use FlexyProject\GitHub\Receiver\Issues\AbstractIssues;
use FlexyProject\GitHub\Receiver\Miscellaneous\AbstractMiscellaneous;
use FlexyProject\GitHub\Receiver\Organizations\AbstractOrganizations;
use FlexyProject\GitHub\Receiver\PullRequests\AbstractPullRequests;
use FlexyProject\GitHub\Receiver\Repositories\AbstractRepositories;

/**
 * Class Api
 *
 * @package FlexyProject\GitHub\Receiver
 */
trait Api
{
    /** @var  mixed */
    protected $api;

    /**
     * Get api
     *
     * @return AbstractApi|AbstractActivity|AbstractEnterprise|AbstractGists|AbstractGitData|AbstractIssues|AbstractMiscellaneous|AbstractOrganizations|AbstractPullRequests|AbstractRepositories
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Set api
     *
     * @param AbstractApi|AbstractActivity|AbstractEnterprise|AbstractGists|AbstractGitData|AbstractIssues|AbstractMiscellaneous|AbstractOrganizations|AbstractPullRequests|AbstractRepositories $api
     *
     * @return Api
     */
    public function setApi($api): self
    {
        $this->api = $api;

        return $this;
    }
}
