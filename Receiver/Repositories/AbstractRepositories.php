<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

use Scion\Services\GitHub\Receiver\Repositories;

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