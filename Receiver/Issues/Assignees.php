<?php
namespace Scion\GitHub\Receiver\Issues;

class Assignees extends AbstractIssues {

	/**
	 * List assignees
	 * @see https://developer.github.com/v3/issues/assignees/#list-assignees
	 * @return mixed
	 */
	public function listAssignees() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/assignees', $this->getIssues()->getOwner(), $this->getIssues()->getRepo())
		);
	}

	/**
	 * Check assignee
	 * @see  https://developer.github.com/v3/issues/assignees/#check-assignee
	 * @param string $assignee
	 * @return mixed
	 */
	public function checkAssignee($assignee) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/assignees/%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $assignee)
		);
	}
} 