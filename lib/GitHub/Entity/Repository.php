<?php
namespace GitHub\Entity;

use File\Parser\Json as JsonParser;

class Repository implements EntityInterface {

	/**
	 * Returns formatted data
	 * @return string
	 */
	public function __toString() {
		return JsonParser::decode([

		]);
	}
}