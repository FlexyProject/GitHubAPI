<?php
namespace Scion\GitHub\Receiver\Search;

use Scion\GitHub\Receiver\Search;

class AbstractSearch {

	protected $search;
	protected $api;

	/**
	 * Constructor
	 * @param Search $search
	 */
	public function __construct(Search $search) {
		$this->search = $search;
		$this->api    = $search->getApi();
	}
} 