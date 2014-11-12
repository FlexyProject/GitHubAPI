<?php
namespace Scion\Services\GitHub\Entity;

use Scion\File\Parser\Json as JsonParser;
use Scion\Stdlib\DateTime;

class Commit implements EntityInterface {

	protected $id        = null;
	protected $distinct  = false;
	protected $message   = null;
	protected $timestamp = '';
	protected $url       = '';
	protected $author    = null;
	protected $committer = null;
	protected $added     = [];
	protected $removed   = [];
	protected $modified  = [];

	/**
	 * Get modified
	 * @return array
	 */
	public function getModified() {
		return $this->modified;
	}

	/**
	 * Set modified
	 * @param array $modified
	 * @return Commit
	 */
	public function setModified($modified) {
		$this->modified = $modified;

		return $this;
	}

	/**
	 * Get added
	 * @return array
	 */
	public function getAdded() {
		return $this->added;
	}

	/**
	 * Set added
	 * @param array $added
	 * @return Commit
	 */
	public function setAdded($added) {
		$this->added = $added;

		return $this;
	}

	/**
	 * Get author
	 * @return null
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Set author
	 * @param \Traversable $author
	 * @return Commit
	 */
	public function setAuthor($author) {
		$user = new User();
		foreach ($author as $key => $value) {
			$methodName = 'set' . ucfirst($key);
			if (method_exists($user, $methodName)) {
				$user->$methodName($value);
			}
		}
		$this->author = $user;

		return $this;
	}

	/**
	 * Get committer
	 * @return null
	 */
	public function getCommitter() {
		return $this->committer;
	}

	/**
	 * Set committer
	 * @param \Traversable $committer
	 * @return Commit
	 */
	public function setCommitter($committer) {
		$user = new User();
		foreach ($committer as $key => $value) {
			$methodName = 'set' . ucfirst($key);
			if (method_exists($user, $methodName)) {
				$user->$methodName($value);
			}
		}
		$this->committer = $user;

		return $this;
	}

	/**
	 * Get distinct
	 * @return boolean
	 */
	public function getDistinct() {
		return $this->distinct;
	}

	/**
	 * Set distinct
	 * @param boolean $distinct
	 * @return Commit
	 */
	public function setDistinct($distinct) {
		$this->distinct = $distinct;

		return $this;
	}

	/**
	 * Get id
	 * @return null
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set id
	 * @param null $id
	 * @return Commit
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * Get message
	 * @return null
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Set message
	 * @param null $message
	 * @return Commit
	 */
	public function setMessage($message) {
		$this->message = $message;

		return $this;
	}

	/**
	 * Get removed
	 * @return array
	 */
	public function getRemoved() {
		return $this->removed;
	}

	/**
	 * Set removed
	 * @param array $removed
	 * @return Commit
	 */
	public function setRemoved($removed) {
		$this->removed = $removed;

		return $this;
	}

	/**
	 * Get timestamp
	 * @return string
	 */
	public function getTimestamp() {
		return $this->timestamp;
	}

	/**
	 * Set timestamp
	 * @param string $timestamp
	 * @return Commit
	 */
	public function setTimestamp($timestamp) {
		$this->timestamp = (new DateTime($timestamp))->format(DateTime::ISO8601);

		return $this;
	}

	/**
	 * Get url
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Set url
	 * @param string $url
	 * @return Commit
	 */
	public function setUrl($url) {
		$this->url = $url;

		return $this;
	}

	/**
	 * Returns formatted data
	 * @return string
	 */
	public function __toString() {
		return JsonParser::decode([
			'id'        => $this->getId(),
			'distinct'  => $this->getDistinct(),
			'message'   => $this->getMessage(),
			'timestamp' => $this->getTimestamp(),
			'url'       => $this->getUrl(),
			'author'    => (string)$this->getAuthor(),
			'committer' => (string)$this->getCommitter(),
			'added'     => $this->getAdded(),
			'removed'   => $this->getRemoved(),
			'modified'  => $this->getModified()
		]);
	}
}