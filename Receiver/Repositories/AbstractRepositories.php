<?php
namespace Scion\GitHub\Receiver\Repositories;

use Scion\GitHub\Receiver\Repositories;

abstract class AbstractRepositories {

	/** Properties */
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