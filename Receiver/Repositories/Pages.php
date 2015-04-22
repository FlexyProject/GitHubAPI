<?php
namespace Scion\GitHub\Receiver\Repositories;

/**
 * The Pages API class provides access to repository's pages.
 * @link    https://developer.github.com/v3/repos/pages/
 * @package Scion\GitHub\Receiver\Repositories
 */
class Pages extends AbstractRepositories {

	/**
	 * Get information about a Pages site
	 * @link https://developer.github.com/v3/repos/pages/#get-information-about-a-pages-site
	 * @return mixed
	 */
	public function getInformation() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/pages', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List Pages builds
	 * @link https://developer.github.com/v3/repos/pages/#list-pages-builds
	 * @return mixed
	 */
	public function listPagesBuilds() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/pages/builds', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List latest Pages build
	 * @link https://developer.github.com/v3/repos/pages/#list-latest-pages-build
	 * @return mixed
	 */
	public function listLatestPagesBuilds() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/repos/:owner/:repo/pages/builds/latest', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}
}