<?php
namespace FlexyProject\GitHub\Receiver\GitData;

use Symfony\Component\HttpFoundation\Request;

/**
 * The References API class provides access to GitData's references
 * @link    https://developer.github.com/v3/git/refs/
 * @package FlexyProject\GitHub\Receiver\GitData
 */
class References extends AbstractGitData {

	/**
	 * Get a Reference
	 * @link https://developer.github.com/v3/git/refs/#get-a-reference
	 * @param string $branch
	 * @return array
	 * @throws \Exception
	 */
	public function get(string $branch): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/refs/heads/:branch', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $branch)
		);
	}

	/**
	 * Get all References
	 * @link https://developer.github.com/v3/git/refs/#get-all-references
	 * @return array
	 * @throws \Exception
	 */
	public function getAll(): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/refs', $this->getGitData()->getOwner(), $this->getGitData()->getRepo())
		);
	}

	/**
	 * Create a Reference
	 * @link https://developer.github.com/v3/git/refs/#create-a-reference
	 * @param string $ref
	 * @param string $sha
	 * @return array
	 * @throws \Exception
	 */
	public function create(string $ref, string $sha): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/refs', $this->getGitData()->getOwner(), $this->getGitData()->getRepo()),
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
	 * @param string $ref
	 * @param string $sha
	 * @param bool   $force
	 * @return array
	 * @throws \Exception
	 */
	public function update(string $ref, string $sha, bool $force = false): array {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/refs/:ref', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $ref),
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
	 * @return bool
	 * @throws \Exception
	 */
	public function delete(string $ref): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/git/refs/:ref', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $ref),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 