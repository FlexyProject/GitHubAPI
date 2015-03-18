<?php
namespace Scion\GitHub\Receiver\Enterprise;

use Scion\Http\Request;

/**
 * Class SearchIndexing
 * @see     https://developer.github.com/v3/enterprise/search_indexing/
 * @package GitHub\Receiver\Enterprise
 */
class SearchIndexing extends AbstractEnterprise {

	/**
	 * Queue an indexing job
	 * @see https://developer.github.com/v3/enterprise/search_indexing/#queue-an-indexing-job
	 * @param string $target
	 * @return mixed
	 */
	public function queueIndexingJob($target) {
		return $this->getApi()->request(
			sprintf('/staff/indexing_jobs?target=%s', $target),
			Request::METHOD_POST
		);
	}
} 