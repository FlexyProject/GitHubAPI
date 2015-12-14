<?php
namespace Scion\GitHub\Receiver;

use Scion\GitHub\AbstractApi;
use Scion\Http\Request;
use Scion\Stdlib\DateTime;

/**
 * This class provides access to Issues API.
 * @link    https://developer.github.com/v3/issues/
 * @package Scion\GitHub\Receiver
 */
class Issues extends AbstractReceiver {

	/** Available sub-Receiver */
	const ASSIGNEES  = 'Assignees';
	const COMMENTS   = 'Comments';
	const EVENTS     = 'Events';
	const LABELS     = 'Labels';
	const MILESTONES = 'Milestones';

	/**
	 * List issues
	 * @link https://developer.github.com/v3/issues/#list-issues
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listIssues($filter = AbstractApi::FILTER_ASSIGNED, $state = AbstractApi::STATE_OPEN, $labels = '', $sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = '1970-01-01') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/issues?:args',
				http_build_query([
					'filter'    => $filter,
					'state'     => $state,
					'labels'    => $labels,
					'sort'      => $sort,
					'direction' => $direction,
					'since'     => (new DateTime($since))->format(DateTime::ATOM)
				])
			)
		);
	}

	/**
	 * List all issues across owned and member repositories for the authenticated user
	 * @link https://developer.github.com/v3/issues/#list-issues
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listUserIssues($filter = AbstractApi::FILTER_ASSIGNED, $state = AbstractApi::STATE_OPEN, $labels = '', $sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = '1970-01-01') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/issues?:args',
				http_build_query([
					'filter'    => $filter,
					'state'     => $state,
					'labels'    => $labels,
					'sort'      => $sort,
					'direction' => $direction,
					'since'     => (new DateTime($since))->format(DateTime::ATOM)
				])
			)
		);
	}

	/**
	 * List all issues for a given organization for the authenticated user
	 * @link https://developer.github.com/v3/issues/#list-issues
	 * @param string $organization
	 * @param string $filter
	 * @param string $state
	 * @param string $labels
	 * @param string $sort
	 * @param string $direction
	 * @param string $since
	 * @return mixed
	 */
	public function listOrganizationIssues($organization, $filter = AbstractApi::FILTER_ASSIGNED, $state = AbstractApi::STATE_OPEN, $labels = '', $sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = '1970-01-01') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org/issues?:args', $organization,
				http_build_query([
					'filter'    => $filter,
					'state'     => $state,
					'labels'    => $labels,
					'sort'      => $sort,
					'direction' => $direction,
					'since'     => (new DateTime($since))->format(DateTime::ATOM)
				])
			)
		);
	}

	/**
	 * List issues for a repository
	 * @link https://developer.github.com/v3/issues/#list-issues-for-a-repository
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
	public function listRepositoryIssues($milestone = '*', $state = AbstractApi::STATE_OPEN, $assignee = '*', $creator = '', $mentioned = '', $labels = '', $sort = AbstractApi::SORT_CREATED, $direction = AbstractApi::DIRECTION_DESC, $since = '1970-01-01') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues?:args', $this->getOwner(), $this->getRepo(),
				http_build_query([
					'milestone' => $milestone,
					'state'     => $state,
					'assignee'  => $assignee,
					'creator'   => $creator,
					'mentioned' => $mentioned,
					'labels'    => $labels,
					'sort'      => $sort,
					'direction' => $direction,
					'since'     => (new DateTime($since))->format(DateTime::ATOM)
				])
			)
		);
	}

	/**
	 * Get a single issue
	 * @link https://developer.github.com/v3/issues/#get-a-single-issue
	 * @param int $number
	 * @return mixed
	 */
	public function getIssue($number) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/:number', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Create an issue
	 * @link https://developer.github.com/v3/issues/#create-an-issue
	 * @param string $title
	 * @param string $body
	 * @param string $assignee
	 * @param int    $milestone
	 * @param array  $labels
	 * @return mixed
	 */
	public function createIssue($title, $body = '', $assignee = '', $milestone = 0, $labels = []) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues', $this->getOwner(), $this->getRepo()),
			Request::METHOD_POST,
			[
				'title'     => $title,
				'body'      => $body,
				'assignee'  => $assignee,
				'milestone' => $milestone,
				'labels'    => $labels
			]
		);
	}

	/**
	 * Edit an issue
	 * @link https://developer.github.com/v3/issues/#edit-an-issue
	 * @param int    $number
	 * @param string $title
	 * @param string $body
	 * @param string $assignee
	 * @param int    $milestone
	 * @param array  $labels
	 * @return mixed
	 */
	public function editIssue($number, $title = '', $body = '', $assignee = '', $milestone = 0, $labels = []) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/issues/:number', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_PATCH,
			[
				'title'     => $title,
				'body'      => $body,
				'assignee'  => $assignee,
				'milestone' => $milestone,
				'labels'    => $labels
			]
		);
	}
} 