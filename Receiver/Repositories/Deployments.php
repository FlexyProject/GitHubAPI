<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Deployments API class provides access to repository's deployments.
 * @link    https://developer.github.com/v3/repos/deployments/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Deployments extends AbstractRepositories {

	/**
	 * List Deployments
	 * @link https://developer.github.com/v3/repos/deployments/#list-deployments
	 * @param string $sha
	 * @param string $ref
	 * @param string $task
	 * @param string $environment
	 * @return mixed
	 */
	public function listDeployments($sha = null, $ref = null, $task = null, $environment = null) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/deployments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), http_build_query(['sha' => $sha, 'ref' => $ref, 'task' => $task, 'environment' => $environment]))
		);
	}

	/**
	 * Create a Deployment
	 * @link https://developer.github.com/v3/repos/deployments/#create-a-deployment
	 * @param string $ref
	 * @param string $task
	 * @param bool   $autoMerge
	 * @param array  $requiredContexts
	 * @param string $payload
	 * @param string $environment
	 * @param string $description
	 * @return mixed
	 */
	public function createDeployement($ref, $task = AbstractApi::TASK_DEPLOY, $autoMerge = true, $requiredContexts = [], $payload = '', $environment = AbstractApi::ENVIRONMENT_PRODUCTION, $description = '') {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/deployments', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			[
				'ref'               => $ref,
				'task'              => $task,
				'auto_merge'        => $autoMerge,
				'required_contexts' => $requiredContexts,
				'payload'           => $payload,
				'environment'       => $environment,
				'description'       => $description
			]
		);
	}

	/**
	 * List Deployment Statuses
	 * @link https://developer.github.com/v3/repos/deployments/#list-deployment-statuses
	 * @param int $id
	 * @return mixed
	 */
	public function listDeploymentStatus($id) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/deployments/:id/statuses', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Create a Deployment Status
	 * @link https://developer.github.com/v3/repos/deployments/#create-a-deployment-status
	 * @param int    $id
	 * @param string $state
	 * @param string $targetUrl
	 * @param string $description
	 * @return mixed
	 */
	public function createDeploymentStatus($id, $state, $targetUrl = '', $description = '') {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/deployments/:id/statuses', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id),
			Request::METHOD_POST,
			[
				'state'       => $state,
				'target_url'  => $targetUrl,
				'description' => $description
			]
		);
	}
} 