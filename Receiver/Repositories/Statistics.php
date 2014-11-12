<?php
namespace Scion\Services\GitHub\Receiver\Repositories;

class Statistics extends AbstractRepositories {

	/**
	 * Get contributors list with additions, deletions, and commit counts
	 * @see https://developer.github.com/v3/repos/statistics/#contributors
	 * @return mixed
	 */
	public function listContributors() {
		return $this->api->request(
			sprintf('/repos/:owner/:repo/stats/contributors', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get the last year of commit activity data
	 * @see https://developer.github.com/v3/repos/statistics/#commit-activity
	 * @return mixed
	 */
	public function getCommitActivity() {
		return $this->api->request(
			sprintf('/repos/:owner/:repo/stats/commit_activity', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get the number of additions and deletions per week
	 * @see https://developer.github.com/v3/repos/statistics/#code-frequency
	 * @return mixed
	 */
	public function getCodeFrequency() {
		return $this->api->request(
			sprintf('/repos/:owner/:repo/stats/code_frequency', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get the weekly commit count for the repository owner and everyone else
	 * @see https://developer.github.com/v3/repos/statistics/#participation
	 * @return mixed
	 */
	public function getParticipation() {
		return $this->api->request(
			sprintf('/repos/:owner/:repo/stats/participation', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}

	/**
	 * Get the number of commits per hour in each day
	 * @see https://developer.github.com/v3/repos/statistics/#punch-card
	 * @return mixed
	 */
	public function getPunchCard() {
		return $this->api->request(
			sprintf('/repos/:owner/:repo/stats/punch_card', $this->repositories->getOwner(), $this->repositories->getRepo())
		);
	}
}