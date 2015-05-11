<?php
namespace Scion\GitHub\Receiver\Issues;

/**
 * The Trees API class provides access to Issues's assignees.
 * @link    https://developer.github.com/v3/issues/assignees/
 * @package Scion\GitHub\Receiver\Issues
 */
class Assignees extends AbstractIssues {

	/**
	 * List assignees
	 * @link https://developer.github.com/v3/issues/assignees/#list-assignees
	 * @return mixed
	 */
	public function listAssignees() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/assignees', $this->getIssues()->getOwner(), $this->getIssues()->getRepo())
		);
	}

	/**
	 * Check assignee
	 * @link  https://developer.github.com/v3/issues/assignees/#check-assignee
	 * @param string $assignee
	 * @return boolean
	 */
	public function checkAssignee($assignee) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/assignees/:assignee', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $assignee)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 