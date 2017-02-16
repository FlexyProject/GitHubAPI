<?php
namespace FlexyProject\GitHub\Receiver\Issues;

use DateTime;
use Symfony\Component\HttpFoundation\Request;
use FlexyProject\GitHub\AbstractApi;

/**
 * The Trees API class provides access to Issues's milestones.
 *
 * @link    https://developer.github.com/v3/issues/milestones/
 * @package FlexyProject\GitHub\Receiver\Issues
 */
class Milestones extends AbstractIssues
{

    /**
     * List milestones for a repository
     *
     * @link https://developer.github.com/v3/issues/milestones/#list-milestones-for-a-repository
     *
     * @param string $state
     * @param string $sort
     * @param string $direction
     *
     * @return array
     */
    public function listMilestones(string $state = AbstractApi::STATE_OPEN, string $sort = AbstractApi::SORT_DUE_DATE,
                                   string $direction = AbstractApi::DIRECTION_ASC): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/milestones?:args',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), http_build_query([
                'state'     => $state,
                'sort'      => $sort,
                'direction' => $direction
            ])));
    }

    /**
     * Get a single milestone
     *
     * @link https://developer.github.com/v3/issues/milestones/#get-a-single-milestone
     *
     * @param int $number
     *
     * @return array
     */
    public function getMilestone(int $number): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/milestones/:number',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number));
    }

    /**
     * Create a milestone
     *
     * @link https://developer.github.com/v3/issues/milestones/#create-a-milestone
     *
     * @param string $title
     * @param string $state
     * @param string $description
     * @param string $dueOn
     *
     * @return array
     */
    public function createMilestone(string $title, string $state = AbstractApi::STATE_OPEN, string $description = '',
                                    string $dueOn = ''): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf('/repos/:owner/:repo/milestones', $this->getIssues()->getOwner(),
                                                 $this->getIssues()->getRepo()), Request::METHOD_POST, [
                'title'       => $title,
                'state'       => $state,
                'description' => $description,
                'due_on'      => (new DateTime($dueOn))->format(DateTime::ATOM)
            ]);
    }

    /**
     * Update a milestone
     *
     * @link https://developer.github.com/v3/issues/milestones/#update-a-milestone
     *
     * @param int    $number
     * @param string $title
     * @param string $state
     * @param string $description
     * @param string $dueOn
     *
     * @return array
     */
    public function updateMilestone(int $number, string $title = '', string $state = AbstractApi::STATE_OPEN,
                                    string $description = '', string $dueOn = ''): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/milestones/:number',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number), Request::METHOD_PATCH, [
                'title'       => $title,
                'state'       => $state,
                'description' => $description,
                'due_on'      => (new DateTime($dueOn))->format(DateTime::ATOM)
            ]);
    }

    /**
     * Delete a milestone
     *
     * @link https://developer.github.com/v3/issues/milestones/#delete-a-milestone
     *
     * @param int $number
     *
     * @return bool
     */
    public function deleteMilestone(int $number): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/milestones/:number',
            $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
} 