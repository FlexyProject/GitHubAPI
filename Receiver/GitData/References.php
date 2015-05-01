<?php
namespace Scion\GitHub\Receiver\GitData;

use Scion\Http\Request;

/**
 * The References API class provides access to GitData's references
 * @link    https://developer.github.com/v3/git/refs/
 * @package Scion\GitHub\Receiver\GitData
 */
class References extends AbstractGitData {

	/**
	 * Get a Reference
	 * @link https://developer.github.com/v3/git/refs/#get-a-reference
	 * @param string $branch
	 * @return string
	 * @throws \Exception
	 */
	public function get($branch) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/refs/heads/:branch', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $branch)
		);
	}

	/**
	 * Get all References
	 * @link https://developer.github.com/v3/git/refs/#get-all-references
	 * @return string
	 * @throws \Exception
	 */
	public function getAll() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/refs', $this->getGitData()->getOwner(), $this->getGitData()->getRepo())
		);
	}

	/**
	 * Create a Reference
	 * @link https://developer.github.com/v3/git/refs/#create-a-reference
	 * @param string $ref
	 * @param string $sha
	 * @return string
	 * @throws \Exception
	 */
	public function create($ref, $sha) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/refs', $this->getGitData()->getOwner(), $this->getGitData()->getRepo()),
			Request::METHOD_POST,
			[
				'ref' => $ref,
				'sha' => $sha
			]
		);
	}

	/**
	 * Update a Reference
	 * @link https://developer.github.com/v3/git/refs/#update-a-reference
	 * @param        $ref
	 * @param string $sha
	 * @param bool   $force
	 * @return string
	 * @throws \Exception
	 */
	public function update($ref, $sha, $force = false) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/refs/:ref', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $ref),
			Request::METHOD_POST,
			[
				'sha'   => $sha,
				'force' => $force
			]
		);
	}

	/**
	 * Delete a Reference
	 * @link https://developer.github.com/v3/git/refs/#delete-a-reference
	 * @param string $ref
	 * @return boolean
	 * @throws \Exception
	 */
	public function delete($ref) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/refs/:ref', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $ref),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 