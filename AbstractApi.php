<?php
namespace Scion\Services\GitHub;

use Scion\Http\Client\Curl;
use Scion\Http\Request;
use Scion\File\Parser\Json as JsonParser;

class AbstractApi {

	/** API constants */
	const API_URL     = 'https://api.github.com';
	const API_UPLOADS = 'https://uploads.github.com';
	const API_RAW_URL = 'https://raw.github.com';

	/** Default branches */
	const BRANCH_MASTER  = 'master';
	const BRANCH_DEVELOP = 'develop';

	/** Archive type */
	const ARCHIVE_TARBALL = 'tarball';
	const ARCHIVE_ZIPBALL = 'zipball';

	/** Client constants */
	const USER_AGENT = 'scion-framework.github-api';

	/** Protected properties */
	protected $timeout = 240;
	protected $success;
	protected $clientId;
	protected $clientSecret;

	/**
	 * Get clientId
	 * @return mixed
	 */
	public function getClientId() {
		return $this->clientId;
	}

	/**
	 * Set clientId
	 * @param mixed $clientId
	 * @return AbstractApi
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;

		return $this;
	}

	/**
	 * Get clientSecret
	 * @return mixed
	 */
	public function getClientSecret() {
		return $this->clientSecret;
	}

	/**
	 * Set clientSecret
	 * @param mixed $clientSecret
	 * @return AbstractApi
	 */
	public function setClientSecret($clientSecret) {
		$this->clientSecret = $clientSecret;

		return $this;
	}

	/**
	 * @param string $url
	 * @param string $method
	 * @param string $prefix
	 * @return mixed
	 */
	public function request($url, $method = Request::METHOD_GET, $prefix = self::API_URL) {

		/** Building url */
		$url = $prefix . $url;
		if (null !== $this->clientId && null !== $this->clientSecret) {
			$url .= (strstr($url, '?') !== false ? '&' : '?');
			$url .= sprintf('client_id=%s&client_secret=%s', $this->clientId, $this->clientSecret);
		}

		/** Call curl */
		$curl = new Curl();
		$curl->setOption([
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_USERAGENT      => self::USER_AGENT,
			CURLOPT_TIMEOUT        => $this->timeout,
			CURLOPT_HEADER         => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
			CURLOPT_URL            => $url
		]);

		/** Methods */
		switch ($method) {
			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.7 */
			case Request::METHOD_DELETE:
				$curl->setOption(CURLOPT_CUSTOMREQUEST, Request::METHOD_DELETE);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.3 */
			case Request::METHOD_GET:
				$curl->setOption(CURLOPT_HTTPGET, true);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4 */
			case Request::METHOD_HEAD:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => Request::METHOD_HEAD,
					CURLOPT_NOBODY        => true
				]);
				break;

			/** @see http://tools.ietf.org/html/rfc5789 */
			case Request::METHOD_PATCH:
				$curl->setOption(CURLOPT_CUSTOMREQUEST, Request::METHOD_PATCH);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.5 */
			case Request::METHOD_POST:
				$curl->setOption(CURLOPT_POST, true);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.6 */
			case Request::METHOD_PUT:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => Request::METHOD_PUT,
					CURLOPT_PUT           => true,
					CURLOPT_HTTPHEADER    => [
						'X-HTTP-Method-Override: PUT',
						'Content-type: application/x-www-form-urlencoded'
					]
				]);
				break;

			default:
				break;
		}

		$curl->success(function ($instance) {
			$this->success = JsonParser::decode($instance->response);
		});
		$curl->perform();

		return $this->success;
	}

} 