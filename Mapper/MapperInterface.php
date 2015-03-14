<?php
namespace Scion\GitHub\Mapper;

interface MapperInterface {

	/**
	 * Map object
	 * @param object $data
	 * @return mixed
	 */
	public function map($data);
} 