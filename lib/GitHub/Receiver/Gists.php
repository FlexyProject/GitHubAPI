<?php
namespace FlexyProject\GitHub\Receiver;

use DateTime;
use Symfony\Component\HttpFoundation\Request;

/**
 * This class provides access to Gists API.
 *
 * @link    https://developer.github.com/v3/gists/
 * @package FlexyProject\GitHub\Receiver
 */
class Gists extends AbstractReceiver
{

    /** Available sub-Receiver */
    const COMMENTS = 'Comments';

    /**
     * List a user's gists
     *
     * @link https://developer.github.com/v3/gists/#list-a-users-gists
     *
     * @param string $username
     * @param string $since
     *
     * @return array
     */
    public function listGists(string $username = null, string $since = '1970-01-01'): array
    {
        $url = '/gists';
        if (null !== $username) {
            $url = '/users/:username/gists';
        }

        return $this->getApi()->request($this->getApi()->sprintf(
            ':url?:arg',
            $url,
            $username,
            http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)])
        ));
    }

    /**
     * List all public gists:
     *
     * @link https://developer.github.com/v3/gists/#list-all-public-gists
     *
     * @param string $since
     *
     * @return array
     */
    public function listPublicGists(string $since = '1970-01-01'): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/gists/public?:arg',
            http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)])
        ));
    }

    /**
     * List the authenticated user’s starred gists
     *
     * @link https://developer.github.com/v3/gists/#list-starred-gists
     *
     * @param string $since
     *
     * @return array
     */
    public function listUsersStarredGists(string $since = '1970-01-01'): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/gists/starred?:arg',
            http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)])
        ));
    }

    /**
     * Get a single gist
     *
     * @link https://developer.github.com/v3/gists/#get-a-single-gist
     *
     * @param string $id
     *
     * @return array
     */
    public function getGist(string $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id', $id));
    }

    /**
     * Get a specific revision of a gist
     *
     * @link https://developer.github.com/v3/gists/#get-a-specific-revision-of-a-gist
     *
     * @param string $id
     * @param string $sha
     *
     * @return array
     * @throws \Exception
     */
    public function getGistRevision(string $id, string $sha): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id/:sha', $id, $sha));
    }

    /**
     * Create a gist
     *
     * @link https://developer.github.com/v3/gists/#create-a-gist
     *
     * @param array  $files
     * @param string $description
     * @param bool   $public
     *
     * @return array
     */
    public function createGist(array $files, string $description = null, bool $public = false): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists'), Request::METHOD_POST, [
            'files'       => $files,
            'description' => $description,
            'public'      => $public
        ]);
    }

    /**
     * Edit a gist
     *
     * @link https://developer.github.com/v3/gists/#edit-a-gist
     *
     * @param string $id
     * @param string $description
     * @param array  $files
     * @param string $content
     * @param string $filename
     *
     * @return array
     */
    public function editGist(
        string $id,
        string $description = '',
        array $files = [],
        string $content = '',
        string $filename = ''
    ): array {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id', $id), Request::METHOD_PATCH, [
            'description' => $description,
            'files'       => $files,
            'content'     => $content,
            'filename'    => $filename
        ]);
    }

    /**
     * List gist commits
     *
     * @link https://developer.github.com/v3/gists/#list-gist-commits
     *
     * @param string $id
     *
     * @return array
     */
    public function listGistsCommits(string $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id/commits', $id));
    }

    /**
     * Star a gist
     *
     * @link https://developer.github.com/v3/gists/#star-a-gist
     *
     * @param string $id
     *
     * @return bool
     */
    public function starGist(string $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/gists/:id/star', $id), Request::METHOD_PUT);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Unstar a gist
     *
     * @link https://developer.github.com/v3/gists/#unstar-a-gist
     *
     * @param string $id
     *
     * @return bool
     */
    public function unStarGist(string $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/gists/:id/star', $id), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Check if a gist is starred
     *
     * @link https://developer.github.com/v3/gists/#check-if-a-gist-is-starred
     *
     * @param string $id
     *
     * @return bool
     */
    public function checkGistIsStarred(string $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/gists/:id/star', $id));

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }

    /**
     * Fork a gist
     *
     * @link https://developer.github.com/v3/gists/#fork-a-gist
     *
     * @param string $id
     *
     * @return array
     */
    public function forkGist(string $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id/forks', $id), Request::METHOD_POST);
    }

    /**
     * List gist forks
     *
     * @link https://developer.github.com/v3/gists/#list-gist-forks
     *
     * @param string $id
     *
     * @return array
     */
    public function listGistForks(string $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:id/forks', $id));
    }

    /**
     * Delete a gist
     *
     * @link https://developer.github.com/v3/gists/#delete-a-gist
     *
     * @param string $id
     *
     * @return bool
     */
    public function deleteGist(string $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/gists/:id', $id), Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
}
