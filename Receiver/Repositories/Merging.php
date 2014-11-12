<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

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
		return $this->api->request(
			sprintf('/repos/%s/%s/merges?base=%s&head=%s&commit_message=%s', $this->repositories->getOwner(), $this->repositories->getRepo(), $base, $head, $commitMessage),
			Request::METHOD_POST
		);
	}
} 