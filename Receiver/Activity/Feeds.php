<?php
namespace Scion\GitHub\Receiver\Activity;

/**
 * The Atom feeds API class provide access to a list of Atom feeds available for the authenticated user.
 * @link    https://developer.github.com/v3/activity/feeds/
 * @package GitHub\Receiver\Activity
 */
class Feeds extends AbstractActivity {

	/**
	 * List Feeds
	 * @link https://developer.github.com/v3/activity/feeds/#list-feeds
	 * @return mixed
	 */
	public function listFeeds() {
		return $this->getApi()->request(
			sprintf('/feeds')
		);
	}
} 