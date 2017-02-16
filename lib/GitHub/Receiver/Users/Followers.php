<?php
namespace FlexyProject\GitHub\Receiver\Users;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Followers API class provide access to manage followers.
 * @link    https://developer.github.com/v3/users/followers/
 * @package FlexyProject\GitHub\Receiver\Users
 */
class Followers extends AbstractUsers {

	/**
	 * List followers of a user
	 * @link https://developer.github.com/v3/users/followers/#list-followers-of-a-user
	 * @param null|string $username
	 * @return array
	 * @throws \Exception
	 */
	public function listFollowers(string $username = null): array {
		$url = '/user/followers';
		if (null !== $username) {
			$url = $this->getApi()->sprintf('/users/:username/followers', $username);
		}

		return $this->getApi()->request($url);
	}

	/**
	 * List users followed by another user
	 * @link https://developer.github.com/v3/users/followers/#list-users-followed-by-another-user
	 * @param null|string $username
	 * @return array
	 * @throws \Exception
	 */
	public function listUsersFollowedBy(string $username = null): array {
		$url = '/user/following';
		if (null !== $username) {
			$url = $this->getApi()->sprintf('/users/:username/following', $username);
		}

		return $this->getApi()->request($url);
	}

	/**
	 * Check if you are following a user
	 * @link https://developer.github.com/v3/users/followers/#check-if-you-are-following-a-user
	 * @param string $username
	 * @return bool
	 * @throws \Exception
	 */
	public function checkFollowingUser(string $username): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/following/:username', $username)
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
	public function checkUserFollowsAnother(string $username, string $targetUser): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/users/:username/following/:target_user', $username, $targetUser)
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
	public function followUser(string $username): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/following/:username', $username),
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
	public function unfollowUser(string $username): bool {
		$this->getApi()->request(
			$this->getApi()->sprintf('/user/following/:username', $username),
			Request::METHOD_DELETE
		);

		if ($this->getApi()->getHeaders()['Status'] == '204 No Content') {
			return true;
		}

		return false;
	}
} 