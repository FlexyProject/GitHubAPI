<?php
namespace Scion\Services\GitHub;

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
	 * @return mixed
	 */
	public function getReceiver($receiver) {
		$class = sprintf('%s\Receiver\%s', __NAMESPACE__, $receiver);

		return new $class($this);
	}

} 