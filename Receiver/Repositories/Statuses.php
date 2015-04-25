<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

/**
 * The Statuses API class provides access to repository's statuses.
 * @link    https://developer.github.com/v3/repos/statuses/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Statuses extends AbstractRepositories {

	/**
	 * Create a Status
	 * @link https://developer.github.com/v3/repos/statuses/#create-a-status
	 * @param string $sha
	 * @param string $state
	 * @param string $targetUrl
	 * @param string $description
	 * @param string $context
	 * @return mixed
	 */
	public function createStatus($sha, $state, $targetUrl = null, $description = null, $context = 'default') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/statuses/:sha', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha),
			Request::METHOD_POST,
			[
				'state'       => $state,
				'target_url'  => $targetUrl,
				'description' => $description,
				'context'     => $context
			]
		);
	}

	/**
	 * List Statuses for a specific Ref
	 * @link https://developer.github.com/v3/repos/statuses/#list-statuses-for-a-specific-ref
	 * @param string $ref
	 * @return mixed
	 */
	public function listStatuses($ref) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits/:ref/statuses', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref)
		);
	}

	/**
	 * Get the combined Status for a specific Ref
	 * @link https://developer.github.com/v3/repos/statuses/#get-the-combined-status-for-a-specific-ref
	 * @param string $ref
	 * @return mixed
	 */
	public function getCombinedStatus($ref) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/commits/:ref/status', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref)
		);
	}
} 