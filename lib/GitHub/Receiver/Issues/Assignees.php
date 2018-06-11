<?php
namespace FlexyProject\GitHub\Receiver\Issues;

/**
 * The Trees API class provides access to Issues's assignees.
 *
 * @link    https://developer.github.com/v3/issues/assignees/
 * @package FlexyProject\GitHub\Receiver\Issues
 */
class Assignees extends AbstractIssues
{

    /**
     * List assignees
     *
     * @link https://developer.github.com/v3/issues/assignees/#list-assignees
     * @return array
     */
    public function listAssignees(): array
    {
        return $this->getApi()->request($this->getApi()
                                             ->sprintf(
                                                 '/repos/:owner/:repo/assignees',
                                                 $this->getIssues()->getOwner(),
                                                 $this->getIssues()->getRepo()
                                             ));
    }

    /**
     * Check assignee
     *
     * @link  https://developer.github.com/v3/issues/assignees/#check-assignee
     *
     * @param string $assignee
     *
     * @return bool
     */
    public function checkAssignee(string $assignee): bool
    {
        $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/assignees/:assignee',
            $this->getIssues()->getOwner(),
            $this->getIssues()->getRepo(),
            $assignee
        ));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
}
