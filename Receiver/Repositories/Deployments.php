<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Deployments extends AbstractRepositories {

	/**
	 * List Deployments
	 * @see https://developer.github.com/v3/repos/deployments/#list-deployments
	 * @param string $sha
	 * @param string $ref
	 * @param string $task
	 * @param string $environment
	 * @return mixed
	 */
	public function listDeployments($sha = '', $ref = '', $task = '', $environment = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/deployments?sha=%s&ref=%s&task=%s&environment=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha, $ref, $task, $environment)
		);
	}

	/**
	 * Create a Deployment
	 * @see https://developer.github.com/v3/repos/deployments/#create-a-deployment
	 * @param string $ref
	 * @param string $task
	 * @param bool   $autoMerge
	 * @param array  $requiredContexts
	 * @param string $payload
	 * @param string $environment
	 * @param string $description
	 * @return mixed
	 */
	public function createDeployement($ref, $task, $autoMerge = true, $requiredContexts = [], $payload = '', $environment = '', $description = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/deployments?ref=%s&task=%s&auto_merge=%s&required_contexts=%s&payload=%s&environement=%s&description=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref, $task, $autoMerge, $requiredContexts, $payload, $environment, $description),
			Request::METHOD_POST
		);
	}

	/**
	 * List Deployment Statuses
	 * @see https://developer.github.com/v3/repos/deployments/#list-deployment-statuses
	 * @param int $id
	 * @return mixed
	 */
	public function listDeploymentStatus($id) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/deployments/%s/statuses', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id)
		);
	}

	/**
	 * Create a Deployment Status
	 * @see https://developer.github.com/v3/repos/deployments/#create-a-deployment-status
	 * @param int    $id
	 * @param string $state
	 * @param string $targetUrl
	 * @param string $description
	 * @return mixed
	 */
	public function createDeploymentStatus($id, $state, $targetUrl = '', $description = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/deployments/%s/statuses?state=%s&target_url=%s&description=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $id, $state, $targetUrl, $description),
			Request::METHOD_POST
		);
	}
} 