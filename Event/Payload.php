<?php
namespace Scion\GitHub\Event;

use Scion\Crypt\Hash;
use Scion\Crypt\Hmac;
use Scion\File\Parser\Json as JsonParser;
use Scion\Http\Request;
use Scion\GitHub\Exception\BadSignatureException;
use Scion\GitHub\Mapper\Commit as CommitMapper;
use Scion\GitHub\WebHook;

class Payload implements EventInterface {

	/** Protected properties */
	protected $webHook;
	protected $secret = null;
	protected $rawData;

	/**
	 * Constructor, pass a WebHook object
	 * @param WebHook $webHook
	 */
	public function __construct(WebHook $webHook) {
		$this->webHook = $webHook;
		$this->rawData = (new Request())->getContent();
	}

	/**
	 * Set secret, encode this secret with Hmac, SHA1 method
	 * @param string $secret
	 * @return $this
	 */
	public function setSecret($secret) {
		$this->secret = Hmac::compute($secret, Hash::ALGO_SHA1, $this->rawData, Hmac::OUTPUT_STRING);

		return $this;
	}

	/**
	 * Get rawData
	 * @return resource|string
	 */
	public function getRawData() {
		return $this->rawData;
	}

	/**
	 * Set rawData
	 * @param resource|string $rawData
	 * @return Payload
	 */
	public function setRawData($rawData) {
		$this->rawData = $rawData;

		return $this;
	}

	/**
	 * Debugger
	 * @return resource|string
	 */
	public function __debugInfo() {
		return [
			'ramData'     => (array)$this->getRawData(),
			'jsonEncoded' => JsonParser::decode($this->getRawData())
		];
	}

	/**
	 * Parse returned data and returns an array
	 * @return mixed
	 * @throws BadSignatureException
	 */
	public function parse() {
		/** Check signature from header */
		if (!$this->_checkSignature()) {
			throw new BadSignatureException('Bad signature');
		}

		/** Decode json data */
		$data = JsonParser::decode($this->getRawData());

		$array = [];
		if (property_exists($data, 'commits')) {
			foreach ($data->commits as $obj) {
				$commit  = new CommitMapper();
				$array[] = $commit->map($obj);
			}
		}

		return $array;
	}

	/**
	 * Check X-Hub-Signature
	 * @throws BadSignatureException
	 * @return bool
	 */
	private function _checkSignature() {
		if (null !== $this->secret) {
			if (isset($_SERVER['HTTP_X_HUB_SIGNATURE'])) {
				list($hash) = explode('=', $_SERVER['HTTP_X_HUB_SIGNATURE'], 2);

				return $this->secret == $hash;
			}

			throw new BadSignatureException('No signature send to the header');
		}

		return true;
	}
}