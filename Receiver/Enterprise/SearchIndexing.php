<?php
namespace Scion\GitHub\Receiver\Enterprise;

use Scion\Http\Request;

/**
 * The Search Indexing API allows you to queue up a variety of search indexing tasks.
 * @link    https://developer.github.com/v3/enterprise/search_indexing/
 * @package GitHub\Receiver\Enterprise
 */
class SearchIndexing extends AbstractEnterprise {

	/**
	 * Queue an indexing job
	 * @link https://developer.github.com/v3/enterprise/search_indexing/#queue-an-indexing-job
	 * @param string $target
	 * @return mixed
	 */
	public function queueIndexingJob($target) {
		return $this->getApi()->request(
			sprintf('/staff/indexing_jobs'),
			Request::METHOD_POST,
			[
				'target' => $target
			]
		);
	}
} 