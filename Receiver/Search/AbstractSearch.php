<?php
namespace Scion\GitHub\Receiver\Search;

use Scion\GitHub\Receiver\Search;

class AbstractSearch {

	/** Properties */
	protected $search;
	protected $api;

	/**
	 * Constructor
	 * @param Search $search
	 */
	public function __construct(Search $search) {
		$this->setSearch($search);
		$this->setApi($search->getApi());
	}

	/**
	 * Get search
	 * @return Search
	 */
	public function getSearch() {
		return $this->search;
	}

	/**
	 * Set search
	 * @param Search $search
	 * @return AbstractSearch
	 */
	public function setSearch($search) {
		$this->search = $search;

		return $this;
	}

	/**
	 * Get api
	 * @return \Scion\GitHub\AbstractApi
	 */
	public function getApi() {
		return $this->api;
	}

	/**
	 * Set api
	 * @param \Scion\GitHub\AbstractApi $api
	 * @return AbstractSearch
	 */
	public function setApi($api) {
		$this->api = $api;

		return $this;
	}
} 