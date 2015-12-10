<?php
namespace Scion\GitHub\Receiver\Issues;

use Scion\Http\Request;
use Scion\GitHub\AbstractApi;
use Scion\Stdlib\DateTime;

/**
 * The Trees API class provides access to Issues's milestones.
 * @link    https://developer.github.com/v3/issues/milestones/
 * @package Scion\GitHub\Receiver\Issues
 */
class Milestones extends AbstractIssues {

	/**
	 * List milestones for a repository
	 * @link https://developer.github.com/v3/issues/milestones/#list-milestones-for-a-repository
	 * @param string $state
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listMilestones($state = AbstractApi::STATE_OPEN, $sort = AbstractApi::SORT_DUE_DATE, $direction = AbstractApi::DIRECTION_ASC) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/milestones?:args', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), http_build_query([
				'state'     => $state,
				'sort'      => $sort,
				'direction' => $direction
			]))
		);
	}

	/**
	 * Get a single milestone
	 * @link https://developer.github.com/v3/issues/milestones/#get-a-single-milestone
	 * @param int $number
	 * @return mixed
	 */
	public function getMilestone($number) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/milestones/:number', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number)
		);
	}

	/**
	 * Create a milestone
	 * @link https://developer.github.com/v3/issues/milestones/#create-a-milestone
	 * @param string $title
	 * @param string $state
	 * @param string $description
	 * @param string $dueOn
	 * @return mixed
	 */
	public function createMilestone($title, $state = AbstractApi::STATE_OPEN, $description = '', $dueOn = '') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/milestones', $this->getIssues()->getOwner(), $this->getIssues()->getRepo()),
			Request::METHOD_POST,
			[
				'title'       => $title,
				'state'       => $state,
				'description' => $description,
				'due_on'      => (new DateTime($dueOn))->format(DateTime::ATOM)
			]
		);
	}

	/**
	 * Update a milestone
	 * @link https://developer.github.com/v3/issues/milestones/#update-a-milestone
	 * @param int    $number
	 * @param string $title
	 * @param string $state
	 * @param string $description
	 * @param string $dueOn
	 * @return mixed
	 */
	public function updateMilestone($number, $title = '', $state = AbstractApi::STATE_OPEN, $description = '', $dueOn = '') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/milestones/:number', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number),
			Request::METHOD_PATCH,
			[
				'title'       => $title,
				'state'       => $state,
				'description' => $description,
				'due_on'      => (new DateTime($dueOn))->format(DateTime::ATOM)
			]
		);
	}

	/**
	 * Delete a milestone
	 * @link https://developer.github.com/v3/issues/milestones/#delete-a-milestone
	 * @param int $number
	 * @return boolean
	 */
	public function deleteMilestone($number) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/milestones/:number', $this->getIssues()->getOwner(), $this->getIssues()->getRepo(), $number),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 