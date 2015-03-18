<?php
namespace Scion\GitHub\Receiver\Activity;

/**
 * Class Feeds
 * @see     https://developer.github.com/v3/activity/feeds/
 * @package GitHub\Receiver\Activity
 */
class Feeds extends AbstractActivity {

	/**
	 * List Feeds
	 * @see https://developer.github.com/v3/activity/feeds/#list-feeds
	 * @return mixed
	 */
	public function listFeeds() {
		return $this->getApi()->request(
			sprintf('/feeds')
		);
	}
} 