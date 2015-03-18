<?php
namespace Scion\GitHub\Receiver\Repositories;

class Pages extends AbstractRepositories {

	/**
	 * Get information about a Pages site
	 * @see https://developer.github.com/v3/repos/pages/#get-information-about-a-pages-site
	 * @return mixed
	 */
	public function getInformation() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/pages', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List Pages builds
	 * @see https://developer.github.com/v3/repos/pages/#list-pages-builds
	 * @return mixed
	 */
	public function listPagesBuilds() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/pages/builds', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}

	/**
	 * List latest Pages build
	 * @see https://developer.github.com/v3/repos/pages/#list-latest-pages-build
	 * @return mixed
	 */
	public function listLatestPagesBuilds() {
		return $this->getApi()->request(
			sprintf('/repos/%s/%s/pages/builds/latest', $this->getRepositories()->getOwner(), $this->getRepositories()->getRepo())
		);
	}
}