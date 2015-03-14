<?php
namespace Scion\GitHub\Mapper;

use Scion\GitHub\Entity\Commit as CommitEntity;
use Scion\Utils\String;

class Commit implements MapperInterface {

	/**
	 * Map object
	 * @param object $data
	 * @return object
	 */
	public function map($data) {
		$commit = new CommitEntity();

		foreach ($data as $key => $value) {
			$methodName = 'set' . ucfirst((string)(new String($key))->dashesToCamelCase());
			if (method_exists($commit, $methodName)) {
				$commit->$methodName($value);
			}
		}

		return $commit;
	}
}