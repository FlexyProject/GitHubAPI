<?php
namespace Scion\GitHub\Receiver\Miscellaneous;

class Emojis extends AbstractMiscellaneous {

	/**
	 * Lists all the emojis available to use on GitHub.
	 * @see https://developer.github.com/v3/emojis/
	 * @return array
	 */
	public function get() {
		return $this->getApi()->request('/emojis');
	}
} 