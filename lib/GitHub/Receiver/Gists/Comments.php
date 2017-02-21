<?php
namespace FlexyProject\GitHub\Receiver\Gists;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Comments API class provides access to gists's comments.
 *
 * @link    https://developer.github.com/v3/gists/comments/
 * @package FlexyProject\GitHub\Receiver\Gists
 */
class Comments extends AbstractGists
{

    /**
     * List comments on a gist
     *
     * @link https://developer.github.com/v3/gists/comments/#list-comments-on-a-gist
     *
     * @param string $gistId
     *
     * @return array
     */
    public function listComments(string $gistId): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:gist_id/comments', $gistId));
    }

    /**
     * Get a single comment
     *
     * @link https://developer.github.com/v3/gists/comments/#get-a-single-comment
     *
     * @param string $gistId
     * @param int    $id
     *
     * @return array
     */
    public function getSingleComment(string $gistId, int $id): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:gist_id/comments/:id', $gistId, (string)$id));
    }

    /**
     * Create a comment
     *
     * @link https://developer.github.com/v3/gists/comments/#create-a-comment
     *
     * @param string $gistId
     * @param string $body
     *
     * @return array
     */
    public function createComment(string $gistId, string $body): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:gist_id/comments', $gistId),
            Request::METHOD_POST, [
                'body' => $body
            ]);
    }

    /**
     * Edit a comment
     *
     * @link https://developer.github.com/v3/gists/comments/#edit-a-comment
     *
     * @param string $gistId
     * @param int    $id
     * @param string $body
     *
     * @return array
     */
    public function editComment(string $gistId, int $id, string $body): array
    {
        return $this->getApi()->request($this->getApi()->sprintf('/gists/:gist_id/comments/:id', $gistId, (string)$id),
            Request::METHOD_PATCH, [
                'body' => $body
            ]);
    }

    /**
     * Delete a comment
     *
     * @link https://developer.github.com/v3/gists/comments/#delete-a-comment
     *
     * @param string $gistId
     * @param int    $id
     *
     * @return bool
     */
    public function deleteComment(string $gistId, int $id): bool
    {
        $this->getApi()->request($this->getApi()->sprintf('/gists/:gist_id/comments/:id', $gistId, (string)$id),
            Request::METHOD_DELETE);

        if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
            return true;
        }

        return false;
    }
} 