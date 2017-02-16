<?php
namespace FlexyProject\GitHub\Event;

use FlexyProject\GitHub\Exception\BadSignatureException;
use FlexyProject\GitHub\WebHook;

class Payload implements EventInterface {

	/** Protected properties */
	protected $webHook;
	protected $secret = null;
	protected $rawData;
	protected $parsedData;

	/**
	 * Constructor, pass a WebHook object
	 * @param WebHook $webHook
	 */
	public function __construct(WebHook $webHook) {
		$this->setWebHook($webHook);
		$this->setRawData($webHook->getRequest()->getContent());
	}

	/**
	 * Get webHook
	 * @return null|WebHook
	 */
	public function getWebHook() {
		return $this->webHook;
	}

	/**
	 * Set webHook
	 * @param mixed $webHook
	 * @return Payload
	 */
	public function setWebHook($webHook): Payload {
		$this->webHook = $webHook;

		return $this;
	}

	/**
	 * Set secret, encode this secret with Hmac, SHA1 method
	 * @param string $secret
	 * @return Payload
	 */
	public function setSecret(string $secret): Payload {
		$this->secret = hash_hmac('sha1', $this->rawData, $secret);

		return $this;
	}

	/**
	 * Get secret
	 * @return null|string
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
	public function setRawData($rawData): Payload {
		$this->rawData = $rawData;

		return $this;
	}

	/**
	 * Get parsedData
	 * @return mixed
	 */
	public function getData() {
		return $this->parsedData;
	}

	/**
	 * Set parsedData
	 * @param mixed $parsedData
	 * @return Payload
	 */
	protected function setParsedData($parsedData): Payload {
		$data = json_decode($parsedData);
		if (JSON_ERROR_NONE === json_last_error()) {
			$this->parsedData = $data;
		}

		return $this;
	}

	/**
	 * Debugger
	 * @return array
	 */
	public function __debugInfo(): array {
		return [
			'ramData'     => (array)$this->getRawData(),
			'jsonEncoded' => json_decode($this->getRawData())
		];
	}

	/**
	 * Parse raw data
	 * @return Payload
	 * @throws BadSignatureException
	 * @throws \Exception
	 */
	public function parse(): Payload {
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
		$this->setParsedData($data);

		return $this;
	}

	/**
	 * Check X-Hub-Signature
	 * @throws BadSignatureException
	 * @return bool
	 */
	private function _checkSignature(): bool {
		if (null !== $this->secret) {
			if ($this->getWebHook()->getRequest()->server->get('HTTP_X_HUB_SIGNATURE')) {
				/**
				 * Split signature into algorithm and hash
				 * @link http://isometriks.com/verify-github-webhooks-with-php
				 */
				list(, $hash) = explode('=', $this->getWebHook()->getRequest()->server->get('HTTP_X_HUB_SIGNATURE'), 2);

				return $this->secret == $hash;
			}

			throw new BadSignatureException('HTTP header "X-Hub-Signature" is missing.');
		}

		return true;
	}
}