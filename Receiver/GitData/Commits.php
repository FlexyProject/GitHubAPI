<?php
namespace Scion\GitHub\Receiver\GitData;

use Scion\Http\Request;
use Scion\Stdlib\DateTime;

/**
 * The Commits API class provides access to GitData's commits.
 * @link    https://developer.github.com/v3/git/commits/
 * @package Scion\GitHub\Receiver\GitData
 */
class Commits extends AbstractGitData {

	/**
	 * Get a Commit
	 * @link https://developer.github.com/v3/git/commits/#get-a-commit
	 * @param string $sha
	 * @return string
	 */
	public function get($sha) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/commits/:sha', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $sha)
		);
	}

	/**
	 * Create a Commit
	 * @link https://developer.github.com/v3/git/commits/#create-a-commit
	 * @param string       $message
	 * @param string       $tree
	 * @param array|string $parents
	 * @param string       $name
	 * @param string       $email
	 * @param string       $date
	 * @return string
	 * @throws \Exception
	 */
	public function create($message, $tree, $parents, $name = null, $email = null, $date = 'now') {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/git/commits', $this->getGitData()->getOwner(), $this->getGitData()->getRepo()),
			Request::METHOD_POST,
			[
				'message' => $message,
				'tree'    => $tree,
				'parents' => $parents,
				'name'    => $name,
				'email'   => $email,
				'date'    => (new DateTime($date))->format(DateTime::ISO8601)
			]
		);
	}
}