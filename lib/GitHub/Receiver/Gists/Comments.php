<?php
namespace GitHub\Receiver\Gists;

use Http\Request;

class Comments extends AbstractGists {

	/**
	 * List comments on a gist
	 * @see https://developer.github.com/v3/gists/comments/#list-comments-on-a-gist
	 * @param int $gistId
	 * @return mixed
	 */
	public function listComments($gistId) {
		return $this->api->request(
			sprintf('/gists/%s/comments', $gistId)
		);
	}

	/**
	 * Get a single comment
	 * @see https://developer.github.com/v3/gists/comments/#get-a-single-comment
	 * @param int $gistId
	 * @param int $id
	 * @return mixed
	 */
	public function getSingleComment($gistId, $id) {
		return $this->api->request(
			sprintf('/gists/%s/comments/%s', $gistId, $id)
		);
	}

	/**
	 * Create a comment
	 * @see https://developer.github.com/v3/gists/comments/#create-a-comment
	 * @param int    $gistId
	 * @param string $body
	 * @return mixed
	 */
	public function createComment($gistId, $body) {
		return $this->api->request(
			sprintf('/gists/%s/comments?body=%s', $gistId, $body),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit a comment
	 * @see https://developer.github.com/v3/gists/comments/#edit-a-comment
	 * @param int    $gistId
	 * @param int    $id
	 * @param string $body
	 * @return mixed
	 */
	public function editComment($gistId, $id, $body) {
		return $this->api->request(
			sprintf('/gists/%s/comments/%s?body=%s', $gistId, $id, $body),
			Request::METHOD_PATCH
		);
	}

	/**
	 * Delete a comment
	 * @see https://developer.github.com/v3/gists/comments/#delete-a-comment
	 * @param int $gistId
	 * @param int $id
	 * @return mixed
	 */
	public function deleteComment($gistId, $id) {
		return $this->api->request(
			sprintf('/gists/%s/comments/%s', $gistId, $id),
			Request::METHOD_DELETE
		);
	}
} 