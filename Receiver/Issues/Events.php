<?php
namespace Scion\GitHub\Receiver\Issues;

/**
 * The Trees API class provides access to Issues's events.
 * @link https://developer.github.com/v3/issues/events/
 * @package Scion\GitHub\Receiver\Issues
 */
class Events extends AbstractIssues {

	/**
	 * List events for an issue
	 * @link https://developer.github.com/v3/issues/events/#list-events-for-an-issue
	 * @param int $issueNumber
	 * @return mixed
	 */
	public function listIssueEvents($issueNumber) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/:issue_number/events', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $issueNumber)
		);
	}

	/**
	 * List events for a repository
	 * @link https://developer.github.com/v3/issues/events/#list-events-for-a-repository
	 * @return mixed
	 */
	public function listRepositoryEvents() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/events', $this->getIssues()->getOwner(), $this->getIssues()->getRepo())
		);
	}

	/**
	 * Get a single event
	 * @link https://developer.github.com/v3/issues/events/#get-a-single-event
	 * @param int $id
	 * @return mixed
	 */
	public function getEvent($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/events/:id', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $id)
		);
	}
} 