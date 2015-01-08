<?php
namespace GitHub\Receiver\Repositories;

use GitHub\Receiver\Repositories;

abstract class AbstractRepositories {

	protected $repositories;
	protected $api;

	/**
	 * Constructor
	 * @param Repositories $repositories
	 */
	public function __construct(Repositories $repositories) {
		$this->repositories = $repositories;
		$this->api          = $repositories->getApi();
	}
} 