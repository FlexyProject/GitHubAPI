<?php
namespace Scion\Services\GitHub;

use Scion\Http\Client\Curl;
use Scion\Http\Request;
use Scion\File\Parser\Json as JsonParser;

class AbstractApi {

	/** API version */
	const API_VERSION = 'v3';

	/** API constants */
	const API_URL     = 'https://api.github.com';
	const API_UPLOADS = 'https://uploads.github.com';
	const API_RAW_URL = 'https://raw.github.com';
	const USER_AGENT  = 'scion-framework.github-api';

	/** Archive constants */
	const ARCHIVE_TARBALL = 'tarball';
	const ARCHIVE_ZIPBALL = 'zipball';

	/** Branch constants */
	const BRANCH_MASTER  = 'master';
	const BRANCH_DEVELOP = 'develop';

	/** Direction constants */
	const DIRECTION_ASC  = 'asc';
	const DIRECTION_DESC = 'desc';

	/** Filter constants */
	const FILTER_ALL        = 'all';
	const FILTER_ASSIGNED   = 'assigned';
	const FILTER_CREATED    = 'created';
	const FILTER_MENTIONED  = 'mentioned';
	const FILTER_SUBSCRIBED = 'subscribed';

	/** Sort constants */
	const SORT_COMPLETENESS = 'completeness';
	const SORT_CREATED      = 'created';
	const SORT_DUE_DATE     = 'due_date';
	const SORT_FULL_NAME    = 'full_name';
	const SORT_NEWEST       = 'newest';
	const SORT_OLDEST       = 'oldest';
	const SORT_PUSHED       = 'pushed';
	const SORT_STARGAZERS   = 'stargazers';
	const SORT_UPDATED      = 'updated';

	/** State constants */
	const STATE_ALL     = 'all';
	const STATE_CLOSED  = 'closed';
	const STATE_ERROR   = 'error';
	const STATE_FAILURE = 'failure';
	const STATE_OPEN    = 'open';
	const STATE_PENDING = 'pending';
	const STATE_SUCCESS = 'success';

	/** Type constants */
	const TYPE_ALL        = 'all';
	const TYPE_COMMENTS   = 'comments';
	const TYPE_GISTS      = 'gists';
	const TYPE_HOOKS      = 'hooks';
	const TYPE_ISSUES     = 'issues';
	const TYPE_MEMBER     = 'member';
	const TYPE_MILESTONES = 'milestones';
	const TYPE_ORGS       = 'orgs';
	const TYPE_OWNER      = 'owner';
	const TYPE_PAGES      = 'pages';
	const TYPE_PUBLIC     = 'public';
	const TYPE_PULLS      = 'pulls';
	const TYPE_PRIVATE    = 'private';
	const TYPE_REPOS      = 'repos';
	const TYPE_USERS      = 'users';

	/** Protected properties */
	protected $apiUrl   = self::API_URL;
	protected $timeout  = 240;
	protected $success;
	protected $failure;
	protected $clientId;
	protected $clientSecret;
	protected $httpAuth = ['username' => '', 'password' => ''];
	protected $token;

	/**
	 * Get apiUrl
	 * @return mixed
	 */
	public function getApiUrl() {
		return $this->apiUrl;
	}

	/**
	 * Set apiUrl
	 * @param mixed $apiUrl
	 * @return AbstractApi
	 */
	public function setApiUrl($apiUrl) {
		$this->apiUrl = $apiUrl;

		return $this;
	}

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
	 * Get httpAuth
	 * @return array
	 */
	public function getHttpAuth() {
		return $this->httpAuth;
	}

	/**
	 * Set httpAuth
	 * @param array $httpAuth
	 * @return AbstractApi
	 */
	public function setHttpAuth(array $httpAuth) {
		$this->httpAuth = $httpAuth;

		return $this;
	}

	/**
	 * Get token
	 * @return string
	 */
	public function getToken() {
		return $this->token;
	}

	/**
	 * Set token
	 * @param string $token
	 * @return AbstractApi
	 */
	public function setToken($token) {
		$this->token = $token;

		return $this;
	}

	/**
	 * Curl request
	 * @param string $url
	 * @param string $method
	 * @param array  $postFields
	 * @return mixed
	 */
	public function request($url, $method = Request::METHOD_GET, $postFields = []) {

		/** Building url */
		$url = $this->getApiUrl() . $url;
		if (null !== $this->clientId && null !== $this->clientSecret) {
			$url .= (strstr($url, '?') !== false ? '&' : '?');
			$url .= http_build_query(['client_id' => $this->clientId, 'client_secret' => $this->clientSecret]);
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
			CURLOPT_HTTPHEADER     => [
				'Accept: application/vnd.github.' . self::API_VERSION . '+json',
				'Content-Type: application/json'
			],
			CURLOPT_URL            => $url
		]);

		/** Basic authentication via username and Password */
		if (!empty($this->getHttpAuth())) {
			$curl->setOption([
				CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
				CURLOPT_USERPWD  => $this->getHttpAuth()['username'] . ':' . $this->getHttpAuth()['password']
			]);
		}

		/** Basic authentication via OAuth token **/
		if (!empty($this->getToken())) {
			$curl->setOption([
				CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
				CURLOPT_USERPWD  => $this->getToken() . ':x-oauth-basic'
			]);
		}

		/** Methods */
		switch ($method) {
			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.7 */
			case Request::METHOD_DELETE:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => $method,
					CURLOPT_POST          => true,
					CURLOPT_POSTFIELDS    => $postFields
				]);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.3 */
			case Request::METHOD_GET:
				$curl->setOption(CURLOPT_HTTPGET, true);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.4 */
			case Request::METHOD_HEAD:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => $method,
					CURLOPT_NOBODY        => true
				]);
				break;

			/** @see http://tools.ietf.org/html/rfc5789 */
			case Request::METHOD_PATCH:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => $method,
					CURLOPT_POST          => true,
					CURLOPT_POSTFIELDS    => $postFields
				]);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.5 */
			case Request::METHOD_POST:
				$curl->setOption([
					CURLOPT_POST       => true,
					CURLOPT_POSTFIELDS => $postFields
				]);
				break;

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.6 */
			case Request::METHOD_PUT:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => $method,
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
		$curl->error(function ($instance) {
			$this->failure = JsonParser::decode($instance->response);
		});
		$curl->perform();

		return $this->success;
	}

} 