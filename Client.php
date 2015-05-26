<?php
namespace Scion\GitHub;

/**
 * Client API v3
 * @link https://developer.github.com/v3/
 * @package Scion\GitHub
 */
class Client extends AbstractApi {

	/** Receiver constants */
	const ACTIVITY      = 'Activity';
	const ENTERPRISE    = 'Enterprise';
	const GISTS         = 'Gists';
	const GIT_DATA      = 'GitData';
	const ISSUES        = 'Issues';
	const MISCELLANEOUS = 'Miscellaneous';
	const ORGANIZATIONS = 'Organizations';
	const PULL_REQUESTS = 'PullRequests';
	const REPOSITORIES  = 'Repositories';
	const SEARCH        = 'Search';
	const USERS         = 'Users';

	/**
	 * Returns receiver object
	 * @param string $receiver
	 * @return object
	 */
	public function getReceiver($receiver) {
		$class = $this->getString()->sprintf(':namespace\Receiver\:receiver', __NAMESPACE__, $receiver);

		return new $class($this);
	}

} 