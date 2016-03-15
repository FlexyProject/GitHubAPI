<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Merging API class provides access to repository's merging.
 * @link    https://developer.github.com/v3/repos/merging/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Merging extends AbstractRepositories {

	/**
	 * Perform a merge
	 * @link https://developer.github.com/v3/repos/merging/#perform-a-merge
	 * @param string      $base
	 * @param string      $head
	 * @param string|null $commitMessage
	 * @return mixed
	 */
	public function performMerge($base, $head, $commitMessage = null) {
		return $this->getApi()->request(
			$this->getApi()->sprintf('/repos/:owner/:repo/merges', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo()),
			Request::METHOD_POST,
			[
				'base'           => $base,
				'head'           => $head,
				'commit_message' => $commitMessage
			]
		);
	}
} 