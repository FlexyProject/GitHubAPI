<?php
namespace FlexyProject\GitHub\Receiver;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\{
    Activity\AbstractActivity, Enterprise\AbstractEnterprise, Gists\AbstractGists, GitData\AbstractGitData,
    Issues\AbstractIssues, Miscellaneous\AbstractMiscellaneous, Organizations\AbstractOrganizations,
    PullRequests\AbstractPullRequests, Repositories\AbstractRepositories
};

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