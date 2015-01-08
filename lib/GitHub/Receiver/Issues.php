<?php
namespace GitHub\Receiver;

use Http\Request;
use GitHub\AbstractApi;

class Issues extends AbstractReceiver {

	/** Available sub-Receiver */
	const ASSIGNEES  = 'Assignees';
	const COMMENTS   = 'Comments';
	const EVENTS     = 'Events';
	const LABELS     = 'Labels';
	const MILESTONES = 'Milestones';

	/**
	 * List issues
	 * @see https://developer.github.com/v3/issues/#list-issues
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listIssues(
		$filter = AbstractApi::FILTER_ASSIGNED,
		$state = AbstractApi::STATE_OPEN,
		$labels = '',
		$sort = AbstractApi::SORT_CREATED,
		$direction = AbstractApi::DIRECTION_DESC,
		$since = ''
	) {
		return $this->api->request(
			sprintf('/issues?filter=%s&state=%s&labels=%s&sort=%s&direction=%s&since=%s', $filter, $state, $labels, $sort, $direction, $since)
		);
	}

	/**
	 * List all issues across owned and member repositories for the authenticated user
	 * @see https://developer.github.com/v3/issues/#list-issues
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listUserIssues(
		$filter = AbstractApi::FILTER_ASSIGNED,
		$state = AbstractApi::STATE_OPEN,
		$labels = '',
		$sort = AbstractApi::SORT_CREATED,
		$direction = AbstractApi::DIRECTION_DESC,
		$since = ''
	) {
		return $this->api->request(
			sprintf('/user/issues?filter=%s&state=%s&labels=%s&sort=%s&direction=%s&since=%s', $filter, $state, $labels, $sort, $direction, $since)
		);
	}

	/**
	 * List all issues for a given organization for the authenticated user
	 * @see https://developer.github.com/v3/issues/#list-issues
	 * @param string $organization
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listOrganizationIssues(
		$organization,
		$filter = AbstractApi::FILTER_ASSIGNED,
		$state = AbstractApi::STATE_OPEN,
		$labels = '',
		$sort = AbstractApi::SORT_CREATED,
		$direction = AbstractApi::DIRECTION_DESC,
		$since = ''
	) {
		return $this->api->request(
			sprintf('/orgs/%s/issues?filter=%s&state=%s&labels=%s&sort=%s&direction=%s&since=%s', $organization, $filter, $state, $labels, $sort, $direction, $since)
		);
	}

	/**
	 * List issues for a repository
	 * @see https://developer.github.com/v3/issues/#list-issues-for-a-repository
	 * @param string $milestone
	 * @param string $state
	 * @param string $assignee
	 * @param string $creator
	 * @param string $mentioned
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listRepositoryIssues(
		$milestone = '*',
		$state = AbstractApi::STATE_OPEN,
		$assignee = '*',
		$creator = '',
		$mentioned = '',
		$labels = '',
		$sort = AbstractApi::SORT_CREATED,
		$direction = AbstractApi::DIRECTION_DESC,
		$since = ''
	) {
		return $this->api->request(
			sprintf('/user/issues?milestone=%s&state=%s&assiognee=%s&creator=%s&mentioned=%s&labels=%s&sort=%s&direction=%s&since=%s', $milestone, $state, $assignee, $creator, $mentioned, $labels, $sort, $direction, $since)
		);
	}

	/**
	 * Get a single issue
	 * @see https://developer.github.com/v3/issues/#get-a-single-issue
	 * @param int $number
	 * @return mixed
	 */
	public function getIssue($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Create an issue
	 * @see https://developer.github.com/v3/issues/#create-an-issue
	 * @param string $title
	 * @param string $body
	 * @param string $assignee
	 * @param int    $milestone
	 * @param array  $labels
	 * @return mixed
	 */
	public function createIssue($title, $body = '', $assignee = '', $milestone = 0, $labels = []) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues?title=%s&body=%s&assignee=%s&milestone=%s&labels=%s', $this->getOwner(), $this->getRepo(), $title, $body, $assignee, $milestone, $labels),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit an issue
	 * @see https://developer.github.com/v3/issues/#edit-an-issue
	 * @param int    $number
	 * @param string $title
	 * @param string $body
	 * @param string $assignee
	 * @param int    $milestone
	 * @param array  $labels
	 * @return mixed
	 */
	public function editIssue($number, $title = '', $body = '', $assignee = '', $milestone = 0, $labels = []) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s?title=%s&body=%s&assignee=%s&state=%s&milestone=%s&labels=%s', $this->getOwner(), $this->getRepo(), $number, $title, $body, $assignee, $milestone, $labels),
			Request::METHOD_PATCH
		);
	}
} 