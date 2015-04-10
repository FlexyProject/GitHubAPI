<?php
namespace Scion\GitHub\Receiver\GitData;

class Commits extends AbstractGitData {

	/**
	 * Get a Commit
	 * @see https://developer.github.com/v3/git/commits/#get-a-commit
	 * @param $sha
	 * @return string
	 */
	public function get($sha) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/git/commits/:%s', $this->getGitData()->getOwner(), $this->getGitData()->getRepo(), $sha)
		);
	}

	/**
	 * Create a Commit
	 * @see https://developer.github.com/v3/git/commits/#create-a-commit
	 * @param $message
	 * @param $tree
	 * @param $parents
	 * @return string
	 */
	public function create($message, $tree, $parents) {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/git/commits', $this->getGitData()->getOwner(), $this->getGitData()->getRepo()),
			Request::METHOD_POST,
			[$message, $tree, $parents]
		);
	}
}