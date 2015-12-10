<?php
namespace Scion\GitHub\Receiver;

use Scion\Http\Request;
use Scion\Stdlib\DateTime;

/**
 * This class provides access to Gists API.
 * @link    https://developer.github.com/v3/gists/
 * @package Scion\GitHub\Receiver
 */
class Gists extends AbstractReceiver {

	/** Available sub-Receiver */
	const COMMENTS = 'Comments';

	/**
	 * List gists
	 * @link https://developer.github.com/v3/gists/#list-gists
	 * @param string $username
	 * @param string $since
	 * @return mixed
	 */
	public function listGists($username = null, $since = null) {
		$url = '/gists';
		if (null !== $username) {
			$url = '/users/:username/gists';
		}

		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf(':url?:arg', $url, $username, http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)]))
		);
	}

	/**
	 * List all public gists:
	 * @link https://developer.github.com/v3/gists/#list-gists
	 * @param string $since
	 * @return mixed
	 */
	public function listPublicGists($since = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/public?:arg', http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)]))
		);
	}

	/**
	 * List the authenticated user’s starred gists
	 * @link https://developer.github.com/v3/gists/#list-gists
	 * @param string $since
	 * @return mixed
	 */
	public function listUsersStarredGists($since = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/starred?:arg', http_build_query(['since' => (new DateTime($since))->format(DateTime::ATOM)]))
		);
	}

	/**
	 * Get a single gist
	 * @link https://developer.github.com/v3/gists/#get-a-single-gist
	 * @param int $id
	 * @return mixed
	 */
	public function getGist($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id', $id)
		);
	}

	/**
	 * Get a specific revision of a gist
	 * @link https://developer.github.com/v3/gists/#get-a-specific-revision-of-a-gist
	 * @param string $id
	 * @param string $sha
	 * @return string
	 * @throws \Exception
	 */
	public function getGistRevision($id, $sha) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/:sha', $id, $sha)
		);
	}

	/**
	 * Create a gist
	 * @link https://developer.github.com/v3/gists/#create-a-gist
	 * @param string $files
	 * @param string $description
	 * @param bool   $public
	 * @return mixed
	 */
	public function createGist($files, $description = null, $public = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists'),
			Request::METHOD_POST,
			[
				'file'        => $files,
				'description' => $description,
				'public'      => $public
			]
		);
	}

	/**
	 * Edit a gist
	 * @link https://developer.github.com/v3/gists/#edit-a-gist
	 * @param int    $id
	 * @param string $description
	 * @param string $files
	 * @param string $content
	 * @param string $filename
	 * @return mixed
	 */
	public function editGist($id, $description = '', $files = '{}', $content = '', $filename = '') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id', $id),
			Request::METHOD_PATCH,
			[
				'description' => $description,
				'files'       => $files,
				'content'     => $content,
				'filename'    => $filename
			]
		);
	}

	/**
	 * List gist commits
	 * @link https://developer.github.com/v3/gists/#list-gist-commits
	 * @param int $id
	 * @return mixed
	 */
	public function listGistsCommits($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/commits', $id)
		);
	}

	/**
	 * Star a gist
	 * @link https://developer.github.com/v3/gists/#star-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function starGist($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/star', $id),
			Request::METHOD_PUT
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Unstar a gist
	 * @link https://developer.github.com/v3/gists/#unstar-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function unStarGist($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/star', $id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Check if a gist is starred
	 * @link https://developer.github.com/v3/gists/#check-if-a-gist-is-starred
	 * @param int $id
	 * @return mixed
	 */
	public function checkGistIsStarred($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/star', $id)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Fork a gist
	 * @link https://developer.github.com/v3/gists/#fork-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function forkGist($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/forks', $id),
			Request::METHOD_POST
		);
	}

	/**
	 * List gist forks
	 * @link https://developer.github.com/v3/gists/#list-gist-forks
	 * @param int $id
	 * @return mixed
	 */
	public function listGistForks($id) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id/forks', $id)
		);
	}

	/**
	 * Delete a gist
	 * @link https://developer.github.com/v3/gists/#delete-a-gist
	 * @param int $id
	 * @return mixed
	 */
	public function deleteGist($id) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/gists/:id', $id),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 