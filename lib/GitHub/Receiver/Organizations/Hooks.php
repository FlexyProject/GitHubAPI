<?php
namespace FlexyProject\GitHub\Receiver\Organizations;

use FlexyProject\GitHub\AbstractApi;
use Symfony\Component\HttpFoundation\Request;

/**
 * Hooks API class allow you to receive HTTP POST payloads whenever certain events happen within the organization.
 *
 * @package FlexyProject\GitHub\Receiver\Organizations
 */
class Hooks extends AbstractOrganizations
{

    /**
     * List hooks
     *
     * @link https://developer.github.com/v3/orgs/hooks/#list-hooks
     *
     * @param string $org
     *
     * @return array
     * @throws \Exception
     */
    public function listHooks(string $org): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks', $org));
    }

    /**
     * Get single hook
     *
     * @link https://developer.github.com/v3/orgs/hooks/#get-single-hook
     *
     * @param string $org
     * @param int    $id
     *
     * @return array
     * @throws \Exception
     */
    public function getSingleHook(string $org, int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id));
    }

    /**
     * Create a hook
     *
     * @link https://developer.github.com/v3/orgs/hooks/#create-a-hook
     *
     * @param string       $org
     * @param string       $name
     * @param string|array $config
     * @param array        $events
     * @param bool         $active
     *
     * @return array
     * @throws \Exception
     */
    public function createHook(string $org, string $name, $config, array $events = [AbstractApi::EVENTS_PUSH],
                               bool $active = false): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks', $org), Request::METHOD_POST, [
                'name'   => $name,
                'config' => $config,
                'events' => $events,
                'active' => $active
            ]);
    }

    /**
     * Edit a hook
     *
     * @link https://developer.github.com/v3/orgs/hooks/#edit-a-hook
     *
     * @param string       $org
     * @param int          $id
     * @param string|array $config
     * @param array        $events
     * @param bool         $active
     *
     * @return array
     * @throws \Exception
     */
    public function editHook(string $org, int $id, $config, array $events = [AbstractApi::EVENTS_PUSH],
                             bool $active = false): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id),
            Request::METHOD_PATCH, [
                'config' => $config,
                'events' => $events,
                'active' => $active
            ]);
    }

    /**
     * Ping a hook
     *
     * @link https://developer.github.com/v3/orgs/hooks/#ping-a-hook
     *
     * @param string $org
     * @param int    $id
     *
     * @return bool
     * @throws \Exception
     */
    public function pingHook(string $org, int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks/:id/pings', $org, (string)$id),
            Request::METHOD_POST);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Delete a hook
     *
     * @link https://developer.github.com/v3/orgs/hooks/#delete-a-hook
     *
     * @param string $org
     * @param int    $id
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteHook(string $org, int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/orgs/:org/hooks/:id', $org, (string)$id),
            Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
}