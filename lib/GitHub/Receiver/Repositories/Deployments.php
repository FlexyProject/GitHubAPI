<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * The Deployments API class provides access to repository's deployments.
 *
 * @link    https://developer.github.com/v3/repos/deployments/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Deployments extends AbstractRepositories
{

    /**
     * List Deployments
     *
     * @link https://developer.github.com/v3/repos/deployments/#list-deployments
     *
     * @param string $sha
     * @param string $ref
     * @param string $task
     * @param string $environment
     *
     * @return array
     */
    public function listDeployments(
        string $sha = null,
        string $ref = null,
        string $task = null,
        string $environment = null
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/deployments',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo(),
            http_build_query(['sha' => $sha, 'ref' => $ref, 'task' => $task, 'environment' => $environment])
        ));
    }

    /**
     * Create a Deployment
     *
     * @link https://developer.github.com/v3/repos/deployments/#create-a-deployment
     *
     * @param string $ref
     * @param string $task
     * @param bool   $autoMerge
     * @param array  $requiredContexts
     * @param string $payload
     * @param string $environment
     * @param string $description
     *
     * @return array
     */
    public function createDeployement(
        string $ref,
        string $task = AbstractApi::TASK_DEPLOY,
        bool $autoMerge = true,
        array $requiredContexts = [],
        string $payload = '',
        string $environment = AbstractApi::ENVIRONMENT_PRODUCTION,
        string $description = ''
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/deployments',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo()
        ), Request::METHOD_POST, [
                'ref'               => $ref,
                'task'              => $task,
                'auto_merge'        => $autoMerge,
                'required_contexts' => $requiredContexts,
                'payload'           => $payload,
                'environment'       => $environment,
                'description'       => $description
            ]);
    }

    /**
     * List Deployment Statuses
     *
     * @link https://developer.github.com/v3/repos/deployments/#list-deployment-statuses
     *
     * @param int $id
     *
     * @return array
     */
    public function listDeploymentStatus(int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/deployments/:id/statuses',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo(),
            $id
        ));
    }

    /**
     * Create a Deployment Status
     *
     * @link https://developer.github.com/v3/repos/deployments/#create-a-deployment-status
     *
     * @param int    $id
     * @param string $state
     * @param string $targetUrl
     * @param string $description
     *
     * @return array
     */
    public function createDeploymentStatus(
        int $id,
        string $state,
        string $targetUrl = '',
        string $description = ''
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/deployments/:id/statuses',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo(),
            $id
        ), Request::METHOD_POST, [
                'state'       => $state,
                'target_url'  => $targetUrl,
                'description' => $description
            ]);
    }
}
