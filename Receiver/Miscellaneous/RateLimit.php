<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

/**
 * The Rate Limit API class lets you check your current rate limit status at any time.
 * @link    https://developer.github.com/v3/rate_limit/
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
class RateLimit extends AbstractMiscellaneous {

	/**
	 * Check your current rate limit status at any time using the Rate Limit API described below.
	 * @link https://developer.github.com/v3/rate_limit/#rate-limit
	 * @return string
	 */
	public function get() {
		return $this->getApi()->request('/rate_limit');
	}
} 