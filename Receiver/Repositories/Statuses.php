<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Statuses extends AbstractRepositories {

	/** State constants */
	const STATE_PENDING = 'pending';
	const STATE_SUCCESS = 'success';
	const STATE_ERROR   = 'error';
	const STATE_FAILURE = 'failure';

	/**
	 * Create a Status
	 * @see https://developer.github.com/v3/repos/statuses/#create-a-status
	 * @param string $sha
	 * @param string $state
	 * @param string $targetUrl
	 * @param string $description
	 * @param string $context
	 * @return mixed
	 */
	public function createStatus($sha, $state, $targetUrl = '', $description = '', $context = 'default') {
		return $this->api->request(
			sprintf('/repos/%s/%s/statuses/%s?state=%s&target_url=%s&descripton=%s&context=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $sha, $state, $targetUrl, $description, $context),
			Request::METHOD_POST
		);
	}

	/**
	 * List Statuses for a specific Ref
	 * @see https://developer.github.com/v3/repos/statuses/#list-statuses-for-a-specific-ref
	 * @param string $ref
	 * @return mixed
	 */
	public function listStatuses($ref) {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits/%s/statuses', $this->repositories->getOwner(), $this->repositories->getRepo(), $ref)
		);
	}

	/**
	 * Get the combined Status for a specific Ref
	 * @see https://developer.github.com/v3/repos/statuses/#get-the-combined-status-for-a-specific-ref
	 * @param string $ref
	 * @return mixed
	 */
	public function getCombinedStatus($ref) {
		return $this->api->request(
			sprintf('/repos/%s/%s/commits/%s/status', $this->repositories->getOwner(), $this->repositories->getRepo(), $ref)
		);
	}
} 