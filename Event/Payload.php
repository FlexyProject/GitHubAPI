<?php
namespace Scion\GitHub\Event;

use Scion\Crypt\Hash;
use Scion\Crypt\Hmac;
use Scion\File\Parser\Json as JsonParser;
use Scion\GitHub\Exception\BadSignatureException;
use Scion\GitHub\WebHook;
use Scion\Http\Headers;
use Scion\Http\Request;

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
		$this->setWebHook($webHook);
		$this->setRawData((new Request())->getContent());
	}

	/**
	 * Get webHook
	 * @return mixed
	 */
	public function getWebHook() {
		return $this->webHook;
	}

	/**
	 * Set webHook
	 * @param mixed $webHook
	 * @return Payload
	 */
	public function setWebHook($webHook) {
		$this->webHook = $webHook;

		return $this;
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
	 * Get secret
	 * @return null
	 */
	public function getSecret() {
		return $this->secret;
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
	 * @return array
	 * @throws BadSignatureException
	 * @throws \Exception
	 */
	public function parse() {
		/** Check signature from header */
		if (!$this->_checkSignature()) {
			throw new BadSignatureException('Hook secret does not match.');
		}

		/** Get data from different locations according to content-type */
		switch ($_SERVER['CONTENT_TYPE']) {
			case 'application/json':
				$data = $this->getRawData();
				break;

			case 'application/x-www-form-urlencoded':
				$data = $_POST['payload'];
				break;

			default:
				throw new \Exception('Unsupported content type: "' . $_SERVER['CONTENT_TYPE'] . '"');
		}

		return !isset($data) ?: JsonParser::decode($data);
	}

	/**
	 * Check X-Hub-Signature
	 * @throws BadSignatureException
	 * @return bool
	 */
	private function _checkSignature() {
		if (null !== $this->secret) {
			if (array_key_exists('HTTP_X_HUB_SIGNATURE', Headers::getInstance()->getHttpHeaders())) {
				/**
				 * Split signature into algorithm and hash
				 * @link http://isometriks.com/verify-github-webhooks-with-php
				 */
				list(, $hash) = explode('=', Headers::getInstance()->getHttpHeaders()['HTTP_X_HUB_SIGNATURE'], 2);

				return $this->secret == $hash;
			}

			throw new BadSignatureException('HTTP header "X-Hub-Signature" is missing.');
		}

		return true;
	}
}