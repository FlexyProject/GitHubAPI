<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\Http\Request;

class Merging extends AbstractRepositories {

	/**
	 * Perform a merge
	 * @see https://developer.github.com/v3/repos/merging/#perform-a-merge
	 * @param string $base
	 * @param string $head
	 * @param string $commitMessage
	 * @return mixed
	 */
	public function performMerge($base, $head, $commitMessage = '') {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/merges?base=%s&head=%s&commit_message=%s', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo(), $base, $head, $commitMessage),
			Request::METHOD_POST
		);
	}
} 