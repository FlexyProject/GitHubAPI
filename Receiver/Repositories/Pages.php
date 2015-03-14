<?php
namespace Scion\GitHub\Receiver\Repositories;

class Pages extends AbstractRepositories {

	/**
	 * Get information about a Pages site
	 * @see https://developer.github.com/v3/repos/pages/#get-information-about-a-pages-site
	 * @return mixed
	 */
	public function getInformation() {
		return $this->api->request(
			sprintf('/repos/%s/%s/pages', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * List Pages builds
	 * @see https://developer.github.com/v3/repos/pages/#list-pages-builds
	 * @return mixed
	 */
	public function listPagesBuilds() {
		return $this->api->request(
			sprintf('/repos/%s/%s/pages/builds', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * List latest Pages build
	 * @see https://developer.github.com/v3/repos/pages/#list-latest-pages-build
	 * @return mixed
	 */
	public function listLatestPagesBuilds() {
		return $this->api->request(
			sprintf('/repos/%s/%s/pages/builds/latest', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}
}