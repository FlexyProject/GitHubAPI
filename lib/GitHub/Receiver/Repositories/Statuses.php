<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Statuses API class provides access to repository's statuses.
 *
 * @link    https://developer.github.com/v3/repos/statuses/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Statuses extends AbstractRepositories
{

    /**
     * Create a Status
     *
     * @link https://developer.github.com/v3/repos/statuses/#create-a-status
     *
     * @param string $sha
     * @param string $state
     * @param string $targetUrl
     * @param string $description
     * @param string $context
     *
     * @return array
     */
    public function createStatus(string $sha, string $state, string $targetUrl = null, string $description = null,
                                 string $context = 'default'): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/statuses/:sha',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $sha), Request::METHOD_POST, [
                'state'       => $state,
                'target_url'  => $targetUrl,
                'description' => $description,
                'context'     => $context
            ]);
    }

    /**
     * List Statuses for a specific Ref
     *
     * @link https://developer.github.com/v3/repos/statuses/#list-statuses-for-a-specific-ref
     *
     * @param string $ref
     *
     * @return array
     */
    public function listStatuses(string $ref): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/commits/:ref/statuses',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref));
    }

    /**
     * Get the combined Status for a specific Ref
     *
     * @link https://developer.github.com/v3/repos/statuses/#get-the-combined-status-for-a-specific-ref
     *
     * @param string $ref
     *
     * @return array
     */
    public function getCombinedStatus(string $ref): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/repos/:owner/:repo/commits/:ref/status',
            $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $ref));
    }
} 