<?php
namespace Scion\GitHub;

use Scion\File\Parser\Json as JsonParser;
use Scion\Http\Client\Curl;
use Scion\Http\Request;
use Scion\Utils\String;
use Scion\Validator\Json as JsonValidator;

abstract class AbstractApi {

	/** API version */
	const API_VERSION = 'v3';

	/** API constants */
	const API_URL        = 'https://api.github.com';
	const API_UPLOADS    = 'https://uploads.github.com';
	const API_RAW_URL    = 'https://raw.github.com';
	const CONTENT_TYPE   = 'application/json';
	const DEFAULT_ACCEPT = 'application/vnd.github.' . self::API_VERSION . '+json';
	const USER_AGENT     = 'scion.github-api';

	/** Archive constants */
	const ARCHIVE_TARBALL = 'tarball';
	const ARCHIVE_ZIPBALL = 'zipball';

	/** Authentication constants */
	const OAUTH_AUTH             = 0;
	const OAUTH2_HEADER_AUTH     = 1;
	const OAUTH2_PARAMETERS_AUTH = 2;

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

	/** Media types constants */
	const MEDIA_TYPE_JSON = 'json';
	const MEDIA_TYPE_RAW  = 'raw';
	const MEDIA_TYPE_FULL = 'full';
	const MEDIA_TYPE_TEXT = 'text';

	/** Modes constants */
	const MODE_MARKDOWN = 'markdown';
	const MODE_GFM      = 'gfm';

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

	/** Properties */
	protected $accept         = self::DEFAULT_ACCEPT;
	protected $apiUrl         = self::API_URL;
	protected $authentication = self::OAUTH_AUTH;
	protected $clientId;
	protected $clientSecret;
	protected $contentType    = self::CONTENT_TYPE;
	protected $failure;
	protected $headers        = [];
	protected $httpAuth       = ['username' => '', 'password' => ''];
	protected $success;
	protected $string;
	protected $timeout        = 240;
	protected $token;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->string = new String();
	}

	/**
	 * Get accept
	 * @return mixed
	 */
	public function getAccept() {
		return $this->accept;
	}

	/**
	 * Set accept
	 * @param array|string $accept
	 * @return AbstractApi
	 */
	public function setAccept($accept) {
		$this->accept = $accept;

		return $this;
	}

	/**
	 * Get authentication
	 * @return int
	 */
	public function getAuthentication() {
		return $this->authentication;
	}

	/**
	 * Set authentication
	 * @param int $authentication
	 * @return $this
	 */
	public function setAuthentication($authentication) {
		$this->authentication = $authentication;

		return $this;
	}

	/**
	 * Get apiUrl
	 * @return string
	 */
	public function getApiUrl() {
		return $this->apiUrl;
	}

	/**
	 * Set apiUrl
	 * @param mixed $apiUrl
	 * @return $this
	 */
	public function setApiUrl($apiUrl) {
		$this->apiUrl = $apiUrl;

		return $this;
	}

	/**
	 * Get clientId
	 * @return null|int
	 */
	public function getClientId() {
		return $this->clientId;
	}

	/**
	 * Set clientId
	 * @param mixed $clientId
	 * @return $this
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;

		return $this;
	}

	/**
	 * Get clientSecret
	 * @return null|string
	 */
	public function getClientSecret() {
		return $this->clientSecret;
	}

	/**
	 * Set clientSecret
	 * @param mixed $clientSecret
	 * @return $this
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
	 * @param string $username
	 * @param string $password
	 * @return $this
	 */
	public function setHttpAuth($username, $password = '') {
		$this->httpAuth['username'] = $username;
		$this->httpAuth['password'] = $password;

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
	 * @param int    $authentication
	 * @return $this
	 */
	public function setToken($token, $authentication = self::OAUTH_AUTH) {
		$this->token = $token;
		$this->setAuthentication($authentication);

		return $this;
	}

	/**
	 * Get timeout
	 * @return int
	 */
	public function getTimeout() {
		return $this->timeout;
	}

	/**
	 * Set timeout
	 * @param int $timeout
	 * @return $this
	 */
	public function setTimeout($timeout) {
		$this->timeout = $timeout;

		return $this;
	}

	/**
	 * Get contentType
	 * @return string
	 */
	public function getContentType() {
		return $this->contentType;
	}

	/**
	 * Set contentType
	 * @param string $contentType
	 * @return AbstractApi
	 */
	public function setContentType($contentType) {
		$this->contentType = $contentType;

		return $this;
	}

	/**
	 * Get string
	 * @return \Scion\Utils\String
	 */
	public function getString() {
		return $this->string;
	}

	/**
	 * Get headers
	 * @return array
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * Curl request
	 * @param string      $url
	 * @param string      $method
	 * @param array       $postFields
	 * @param null|string $apiUrl
	 * @return string
	 */
	public function request($url, $method = Request::METHOD_GET, $postFields = [], $apiUrl = null) {
		/** Building url */
		if (null === $apiUrl) {
			$apiUrl = $this->getApiUrl();
		}
		$url = $apiUrl . $url;

		/**
		 * OAuth2 Key/Secret authentication
		 * @see https://developer.github.com/v3/#oauth2-keysecret
		 */
		if (null !== $this->getClientId() && null !== $this->getClientSecret()) {
			$url .= (strstr($url, '?') !== false ? '&' : '?');
			$url .= http_build_query(['client_id' => $this->getClientId(), 'client_secret' => $this->getClientSecret()]);
		}

		/**
		 * Basic authentication via OAuth2 Token (sent as a parameter)
		 * @see https://developer.github.com/v3/#oauth2-token-sent-as-a-parameter
		 */
		else if ($this->getAuthentication() === self::OAUTH2_PARAMETERS_AUTH) {
			$url .= http_build_query(['access_token' => $this->getToken()]);
		}

		/** Call curl */
		$curl = new Curl();
		$curl->setOption([
			CURLOPT_USERAGENT      => self::USER_AGENT,
			CURLOPT_TIMEOUT        => $this->getTimeout(),
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_HTTPHEADER     => [
				'Accept: ' . $this->getAccept(),
				'Content-Type: ' . $this->getContentType()
			],
			CURLOPT_URL            => $url
		]);

		/**
		 * Basic authentication via username and Password
		 * @see https://developer.github.com/v3/auth/#via-username-and-password
		 */
		if (!empty($this->getHttpAuth())) {
			if (!isset($this->getHttpAuth()['password']) || empty($this->getHttpAuth()['password'])) {
				$curl->setOption([
					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
					CURLOPT_USERPWD  => $this->getHttpAuth()['username']
				]);
			}
			else {
				$curl->setOption([
					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
					CURLOPT_USERPWD  => sprintf('%s:%s', $this->getHttpAuth()['username'], $this->getHttpAuth()['password'])
				]);
			}
		}

		if (!empty($this->getToken()) && $this->getAuthentication() !== self::OAUTH2_PARAMETERS_AUTH) {
			/**
			 * Basic authentication via OAuth token
			 * @see https://developer.github.com/v3/auth/#via-oauth-tokens
			 **/
			if ($this->getAuthentication() === self::OAUTH_AUTH) {
				$curl->setOption([
					CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
					CURLOPT_USERPWD  => sprintf('%s:x-oauth-basic', $this->getToken())
				]);
			}
			/**
			 * Basic authentication via OAuth2 Token (sent in a header)
			 * @see https://developer.github.com/v3/#oauth2-token-sent-in-a-header
			 */
			else if ($this->getAuthentication() === self::OAUTH2_HEADER_AUTH) {
				$curl->setOption([
					CURLOPT_HTTPAUTH   => CURLAUTH_BASIC,
					CURLOPT_HTTPHEADER => [sprintf('Authorization: token %s', $this->getToken())]
				]);
			}
		}

		/** Methods */
		switch ($method) {
			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.7 */
			case Request::METHOD_DELETE:
				/** @see http://tools.ietf.org/html/rfc5789 */
			case Request::METHOD_PATCH:
				$curl->setOption([
					CURLOPT_CUSTOMREQUEST => $method,
					CURLOPT_POST          => true,
					CURLOPT_POSTFIELDS    => json_encode(array_filter($postFields))
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

			/** @see http://www.w3.org/Protocols/rfc2616/rfc2616-sec9.html#sec9.5 */
			case Request::METHOD_POST:
				$curl->setOption([
					CURLOPT_POST       => true,
					CURLOPT_POSTFIELDS => json_encode(array_filter($postFields))
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
			$this->headers = $instance->getHeaders();
			$this->success = $instance->response;
			$validator     = new JsonValidator();
			if ($validator->isValid($instance->response)) {
				$this->success = JsonParser::decode($instance->response);
			}
		});
		$curl->error(function ($instance) {
			$this->headers = $instance->getHeaders();
			$this->failure = $instance->response;
			$validator     = new JsonValidator();
			if ($validator->isValid($instance->response)) {
				$this->failure = JsonParser::decode($instance->response);
			}
		});
		$curl->perform();

		return (null != $this->success ? $this->success : $this->failure);
	}
}