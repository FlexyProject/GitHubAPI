<?php
namespace Scion\Services\GitHub\Receiver\Issues;

use Scion\Http\Request;
use Scion\Services\GitHub\AbstractApi;
use Scion\Stdlib\DateTime;

class Milestones extends AbstractIssues {

	/**
	 * List milestones for a repository
	 * @see https://developer.github.com/v3/issues/milestones/#list-milestones-for-a-repository
	 * @param string $state
	 * @param string $sort
	 * @param string $direction
	 * @return mixed
	 */
	public function listMilestones($state = AbstractApi::STATE_OPEN, $sort = AbstractApi::SORT_DUE_DATE, $direction = AbstractApi::DIRECTION_ASC) {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones?state=%s&sort=%s&direction=%s', $this->getOwner(), $this->getRepo(), $state, $sort, $direction)
		);
	}

	/**
	 * Get a single milestone
	 * @see https://developer.github.com/v3/issues/milestones/#get-a-single-milestone
	 * @param int $number
	 * @return mixed
	 */
	public function getMilestone($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones/%s', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Create a milestone
	 * @see https://developer.github.com/v3/issues/milestones/#create-a-milestone
	 * @param string $title
	 * @param string $state
	 * @param string $description
	 * @param string $dueOn
	 * @return mixed
	 */
	public function createMilestone($title, $state = AbstractApi::STATE_OPEN, $description = '', $dueOn = '') {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones?title=%s&state=%s&description=%s&due_one=%s', $this->getOwner(), $this->getRepo(), $title, $state, $description, (new DateTime($dueOn))->format(DateTime::ISO8601)),
			Request::METHOD_POST
		);
	}

	/**
	 * Update a milestone
	 * @see https://developer.github.com/v3/issues/milestones/#update-a-milestone
	 * @param int    $number
	 * @param string $title
	 * @param string $state
	 * @param string $description
	 * @param string $dueOn
	 * @return mixed
	 */
	public function updateMilestone($number, $title = '', $state = AbstractApi::STATE_OPEN, $description = '', $dueOn = '') {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones/%s?title=%s&state=%s&description=%s&due_one=%s', $this->getOwner(), $this->getRepo(), $number, $title, $state, $description, (new DateTime($dueOn))->format(DateTime::ISO8601)),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a milestone
	 * @see https://developer.github.com/v3/issues/milestones/#delete-a-milestone
	 * @param int $number
	 * @return mixed
	 */
	public function deleteMilestone($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones/%s', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_DELETE
		);
	}
} 