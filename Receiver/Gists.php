<?php
namespace Scion\GitHub\Receiver;

use Scion\Http\Request;
use Scion\Stdlib\DateTime;

class Gists extends AbstractReceiver {

	/** Available sub-Receiver */
	const COMMENTS = 'Comments';

	/**
	 * List gists
	 * @see https://developer.github.com/v3/gists/#list-gists
	 * @param string $username
	 * @param string $since
	 * @return mixed
	 */
	public function listGists($username = null, $since = null) {
		if (null !== $username) {
			return $this->getApi()->request(
				sprintf('/users/%s/gists?since=%s', $username, (new DateTime($since))->format(DateTime::ISO8601))
			);
		}

		return $this->getApi()->request(
			sprintf('/gists?since=%s', (new DateTime($since))->format(DateTime::ISO8601))
		);
	}

	/**
	 * List all public gists:
	 * @see https://developer.github.com/v3/gists/#list-gists
	 * @param string $since
	 * @return mixed
	 */
	public function listPublicGists($since = null) {
		return $this->getApi()->request(
			sprintf('/gists/public?since=%s', (new DateTime($since))->format(DateTime::ISO8601))
		);
	}

	/**
	 * List the authenticated user’s starred gists
	 * @see https://developer.github.com/v3/gists/#list-gists
	 * @param string $since
	 * @return mixed
	 */
	public function listUsersStarredGists($since = null) {
		return $this->getApi()->request(
			sprintf('/gists/starred?since=%s', (new DateTime($since))->format(DateTime::ISO8601))
		);
	}

	/**
	 * Get a single gist
	 * @see https://developer.github.com/v3/gists/#get-a-single-gist
	 * @param int $id
	 * @return mixed
	 */
	public function getGist($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s', $id)
		);
	}

	/**
	 * Create a gist
	 * @see https://developer.github.com/v3/gists/#create-a-gist
	 * @param string $files
	 * @param string $description
	 * @param bool   $public
	 * @return mixed
	 */
	public function createGist($files, $description = '', $public = false) {
		return $this->getApi()->request(
			sprintf('/gists?files=%s&description=%s&public=%s', $files, $description, $public),
			Request::METHOD_POST
		);
	}

	/**
	 * Edit a gist
	 * @see https://developer.github.com/v3/gists/#edit-a-gist
	 * @param int    $id
	 * @param string $description
	 * @param string $files
	 * @param string $content
	 * @param string $filename
	 * @return mixed
	 */
	public function editGist($id, $description = '', $files = '{}', $content = '', $filename = '') {
		return $this->getApi()->request(
			sprintf('/gists/%s?description=%s&files=%s&content=%s&content=%s&filename=%s', $id, $description, $files, $content, $filename)
		);
	}

	/**
	 * List gist commits
	 * @see https://developer.github.com/v3/gists/#list-gist-commits
	 * @param int $id
	 * @return mixed
	 */
	public function listGistsCommits($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s/commits', $id)
		);
	}

	/**
	 * Star a gist
	 * @see https://developer.github.com/v3/gists/#star-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function starGist($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s/star', $id),
			Request::METHOD_PUT
		);
	}

	/**
	 * Unstar a gist
	 * @see https://developer.github.com/v3/gists/#unstar-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function unStarGist($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s/star', $id),
			Request::METHOD_DELETE
		);
	}

	/**
	 * Check if a gist is starred
	 * @see https://developer.github.com/v3/gists/#check-if-a-gist-is-starred
	 * @param int $id
	 * @return mixed
	 */
	public function checkGistIsStarred($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s/star', $id)
		);
	}

	/**
	 * Fork a gist
	 * @see https://developer.github.com/v3/gists/#fork-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function forkGist($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s/forks', $id),
			Request::METHOD_POST
		);
	}

	/**
	 * List gist forks
	 * @see https://developer.github.com/v3/gists/#list-gist-forks
	 * @param int $id
	 * @return mixed
	 */
	public function listGistForks($id) {
		return $this->getApi()->request(
			sprintf('/gists/%S/forks', $id)
		);
	}

	/**
	 * Delete a gist
	 * @see https://developer.github.com/v3/gists/#delete-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function deleteGist($id) {
		return $this->getApi()->request(
			sprintf('/gists/%s', $id),
			Request::METHOD_DELETE
		);
	}
} 