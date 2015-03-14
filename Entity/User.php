<?php
namespace Scion\GitHub\Entity;

use Scion\File\Parser\Json as JsonParser;
use Scion\Stdlib\DateTime;

class User implements EntityInterface {

	/** Properties */
	protected $login;
	protected $id;
	protected $avatarUrl;
	protected $gravatarId;
	protected $htmlUrl;
	protected $siteAdmin = false;
	protected $name;
	protected $company;
	protected $blog;
	protected $location;
	protected $email;
	protected $hireable  = false;
	protected $bio;
	protected $publicRepos;
	protected $publicGists;
	protected $followers;
	protected $following;
	protected $createdAt;
	protected $updatedAt;

	/**
	 * Get publicRepos
	 * @return mixed
	 */
	public function getPublicRepos() {
		return $this->publicRepos;
	}

	/**
	 * Set publicRepos
	 * @param mixed $publicRepos
	 * @return User
	 */
	public function setPublicRepos($publicRepos) {
		$this->publicRepos = $publicRepos;

		return $this;
	}

	/**
	 * Get avatarUrl
	 * @return mixed
	 */
	public function getAvatarUrl() {
		return $this->avatarUrl;
	}

	/**
	 * Set avatarUrl
	 * @param mixed $avatarUrl
	 * @return User
	 */
	public function setAvatarUrl($avatarUrl) {
		$this->avatarUrl = $avatarUrl;

		return $this;
	}

	/**
	 * Get bio
	 * @return mixed
	 */
	public function getBio() {
		return $this->bio;
	}

	/**
	 * Set bio
	 * @param mixed $bio
	 * @return User
	 */
	public function setBio($bio) {
		$this->bio = $bio;

		return $this;
	}

	/**
	 * Get blog
	 * @return mixed
	 */
	public function getBlog() {
		return $this->blog;
	}

	/**
	 * Set blog
	 * @param mixed $blog
	 * @return User
	 */
	public function setBlog($blog) {
		$this->blog = $blog;

		return $this;
	}

	/**
	 * Get company
	 * @return mixed
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Set company
	 * @param mixed $company
	 * @return User
	 */
	public function setCompany($company) {
		$this->company = $company;

		return $this;
	}

	/**
	 * Get createdAt
	 * @return mixed
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Set createdAt
	 * @param mixed $createdAt
	 * @return User
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = new DateTime($createdAt);

		return $this;
	}

	/**
	 * Get followers
	 * @return mixed
	 */
	public function getFollowers() {
		return $this->followers;
	}

	/**
	 * Set followers
	 * @param mixed $followers
	 * @return User
	 */
	public function setFollowers($followers) {
		$this->followers = $followers;

		return $this;
	}

	/**
	 * Get following
	 * @return mixed
	 */
	public function getFollowing() {
		return $this->following;
	}

	/**
	 * Set following
	 * @param mixed $following
	 * @return User
	 */
	public function setFollowing($following) {
		$this->following = $following;

		return $this;
	}

	/**
	 * Get gravatarId
	 * @return mixed
	 */
	public function getGravatarId() {
		return $this->gravatarId;
	}

	/**
	 * Set gravatarId
	 * @param mixed $gravatarId
	 * @return User
	 */
	public function setGravatarId($gravatarId) {
		$this->gravatarId = $gravatarId;

		return $this;
	}

	/**
	 * Get hireable
	 * @return boolean
	 */
	public function getHireable() {
		return $this->hireable;
	}

	/**
	 * Set hireable
	 * @param boolean $hireable
	 * @return User
	 */
	public function setHireable($hireable) {
		$this->hireable = $hireable;

		return $this;
	}

	/**
	 * Get htmlUrl
	 * @return mixed
	 */
	public function getHtmlUrl() {
		return $this->htmlUrl;
	}

	/**
	 * Set htmlUrl
	 * @param mixed $htmlUrl
	 * @return User
	 */
	public function setHtmlUrl($htmlUrl) {
		$this->htmlUrl = $htmlUrl;

		return $this;
	}

	/**
	 * Get id
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set id
	 * @param mixed $id
	 * @return User
	 */
	public function setId($id) {
		$this->id = $id;

		return $this;
	}

	/**
	 * Get location
	 * @return mixed
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * Set location
	 * @param mixed $location
	 * @return User
	 */
	public function setLocation($location) {
		$this->location = $location;

		return $this;
	}

	/**
	 * Get publicGists
	 * @return mixed
	 */
	public function getPublicGists() {
		return $this->publicGists;
	}

	/**
	 * Set publicGists
	 * @param mixed $publicGists
	 * @return User
	 */
	public function setPublicGists($publicGists) {
		$this->publicGists = $publicGists;

		return $this;
	}

	/**
	 * Get siteAdmin
	 * @return boolean
	 */
	public function getSiteAdmin() {
		return $this->siteAdmin;
	}

	/**
	 * Set siteAdmin
	 * @param boolean $siteAdmin
	 * @return User
	 */
	public function setSiteAdmin($siteAdmin) {
		$this->siteAdmin = $siteAdmin;

		return $this;
	}

	/**
	 * Get updatedAt
	 * @return mixed
	 */
	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	/**
	 * Set updatedAt
	 * @param mixed $updatedAt
	 * @return User
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = new DateTime($updatedAt);

		return $this;
	}

	/**
	 * Get email
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set email
	 * @param mixed $email
	 * @return User
	 */
	public function setEmail($email) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get name
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set name
	 * @param mixed $name
	 * @return User
	 */
	public function setName($name) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get login
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * Set login
	 * @param mixed $login
	 * @return User
	 */
	public function setLogin($login) {
		$this->login = $login;

		return $this;
	}

	/**
	 * Returns formatted data
	 * @return mixed
	 */
	public function __toString() {
		return JsonParser::encode([
			'login' => $this->getLogin(),
			'id'    => $this->getId(),
			'name'  => $this->getName(),
			'email' => $this->getEmail()
		]);
	}
}