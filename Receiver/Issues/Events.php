<?php
namespace Scion\GitHub\Receiver\Issues;

class Events extends AbstractIssues {

	/**
	 * List events for an issue
	 * @see https://developer.github.com/v3/issues/events/#list-events-for-an-issue
	 * @param int $issueNumber
	 * @return mixed
	 */
	public function listIssueEvents($issueNumber) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/%s/events', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $issueNumber)
		);
	}

	/**
	 * List events for a repository
	 * @see https://developer.github.com/v3/issues/events/#list-events-for-a-repository
	 * @return mixed
	 */
	public function listRepositoryEvents() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/events', $this->getIssues()->getOwner(), $this->getIssues()->getRepo())
		);
	}

	/**
	 * Get a single event
	 * @see https://developer.github.com/v3/issues/events/#get-a-single-event
	 * @param int $id
	 * @return mixed
	 */
	public function getEvent($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/issues/events/%s', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id)
		);
	}
} 