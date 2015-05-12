<?php
namespace Scion\GitHub\Receiver\Users;

use Scion\Http\Request;

/**
 * The Followers API class provide access to manage followers.
 * @link    https://developer.github.com/v3/users/followers/
 * @package Scion\GitHub\Receiver\Users
 */
class Followers extends AbstractUsers {

	/**
	 * List followers of a user
	 * @link https://developer.github.com/v3/users/followers/#list-followers-of-a-user
	 * @param null|string $username
	 * @return string
	 * @throws \Exception
	 */
	public function listFollowers($username = null) {
		$url = '/user/followers';
		if (null !== $username) {
			$url = $this->getApi()->getString()->sprintf('/users/:username/followers', $username);
		}

		return $this->getApi()->request($url);
	}

	/**
	 * List users followed by another user
	 * @link https://developer.github.com/v3/users/followers/#list-users-followed-by-another-user
	 * @param null|string $username
	 * @return string
	 * @throws \Exception
	 */
	public function listUsersFollowedBy($username = null) {
		$url = '/user/following';
		if (null !== $username) {
			$url = $this->getApi()->getString()->sprintf('/users/:username/following', $username);
		}

		return $this->getApi()->request($url);
	}

	/**
	 * Check if you are following a user
	 * @link https://developer.github.com/v3/users/followers/#check-if-you-are-following-a-user
	 * @param string $username
	 * @return boolean
	 * @throws \Exception
	 */
	public function checkFollowingUser($username) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/following/:username', $username)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Check if one user follows another
	 * @link https://developer.github.com/v3/users/followers/#check-if-one-user-follows-another
	 * @param string $username
	 * @param string $targetUser
	 * @return bool
	 * @throws \Exception
	 */
	public function checkUserFollowsAnother($username, $targetUser) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/following/:target_user', $username, $targetUser)
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Follow a user
	 * @link https://developer.github.com/v3/users/followers/#follow-a-user
	 * @param string $username
	 * @return bool
	 * @throws \Exception
	 */
	public function followUser($username) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/following/:username', $username),
			Request::METHOD_PUT
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}

	/**
	 * Unfollow a user
	 * @link https://developer.github.com/v3/users/followers/#unfollow-a-user
	 * @param string $username
	 * @return bool
	 * @throws \Exception
	 */
	public function unfollowUser($username) {
		$this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/following/:username', $username),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 