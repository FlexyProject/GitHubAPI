<?php
namespace Scion\GitHub\Receiver\Issues;

use Scion\Http\Request;

class Labels extends AbstractIssues {

	/**
	 * List all labels for this repository
	 * @see https://developer.github.com/v3/issues/labels/#list-all-labels-for-this-repository
	 * @return mixed
	 */
	public function listRepositoryLabels() {
		return $this->api->request(
			sprintf('/repos/%s/%s/labels', $this->getOwner(), $this->getRepo())
		);
	}

	/**
	 * Get a single label
	 * @see https://developer.github.com/v3/issues/labels/#get-a-single-label
	 * @param string $name
	 * @return mixed
	 */
	public function getLabel($name) {
		return $this->api->request(
			sprintf('/repos/%s/%s/labels/%s', $this->getOwner(), $this->getRepo(), $name)
		);
	}

	/**
	 * Create a label
	 * @see https://developer.github.com/v3/issues/labels/#create-a-label
	 * @param string $name
	 * @param string $color
	 * @return mixed
	 */
	public function createLabel($name, $color) {
		return $this->api->request(
			sprintf('/repos/%s/%s/labels?name=%s&color=%s', $this->getOwner(), $this->getRepo(), $name, $color),
			Request::METHOD_POST
		);
	}

	/**
	 * Update a label
	 * @see https://developer.github.com/v3/issues/labels/#update-a-label
	 * @param string $name
	 * @param string $color
	 * @return mixed
	 */
	public function updateLabel($name, $color) {
		return $this->api->request(
			sprintf('/repos/%s/%s/labels/%s?color=%s', $this->getOwner(), $this->getRepo(), $name, $color),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a label
	 * @see https://developer.github.com/v3/issues/labels/#delete-a-label
	 * @param string $name
	 * @return mixed
	 */
	public function deleteLabel($name) {
		return $this->api->request(
			sprintf('/repos/%s/%s/labels/%s', $this->getOwner(), $this->getRepo(), $name)
		);
	}

	/**
	 * List labels on an issue
	 * @see https://developer.github.com/v3/issues/labels/#list-labels-on-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function listIssueLabels($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s/labels', $this->getOwner(), $this->getRepo(), $number)
		);
	}

	/**
	 * Add labels to an issue
	 * @see https://developer.github.com/v3/issues/labels/#add-labels-to-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function addIssueLabels($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s/labels', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_POST
		);
	}

	/**
	 * Remove a label from an issue
	 * @see https://developer.github.com/v3/issues/labels/#remove-a-label-from-an-issue
	 * @param int    $number
	 * @param string $name
	 * @return mixed
	 */
	public function removeIssueLabel($number, $name) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s/labels/%s', $this->getOwner(), $this->getRepo(), $number, $name),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Replace all labels for an issue
	 * @see https://developer.github.com/v3/issues/labels/#replace-all-labels-for-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function replaceIssuesLabels($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s/labels', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_PUT
		);
	}

	/**
	 * Remove all labels from an issue
	 * @see https://developer.github.com/v3/issues/labels/#remove-all-labels-from-an-issue
	 * @param int $number
	 * @return mixed
	 */
	public function removeIssueLabels($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/issues/%s/labels', $this->getOwner(), $this->getRepo(), $number),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Get labels for every issue in a milestone
	 * @see https://developer.github.com/v3/issues/labels/#get-labels-for-every-issue-in-a-milestone
	 * @param int $number
	 * @return mixed
	 */
	public function getIssueLabelsInMilestone($number) {
		return $this->api->request(
			sprintf('/repos/%s/%s/milestones/%s/labels', $this->getOwner(), $this->getRepo(), $number)
		);
	}
} 