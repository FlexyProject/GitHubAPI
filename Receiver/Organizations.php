<?php
namespace Scion\GitHub\Receiver;

use Scion\Http\Request;

/**
 * This class give you access to the organizations API.
 * @link    https://developer.github.com/v3/orgs/
 * @package Scion\GitHub\Receiver
 */
class Organizations extends AbstractReceiver {

	/** Available sub-Receiver */
	const MEMBERS = 'Members';
	const TEAMS   = 'Teams';
	const HOOKS   = 'Hooks';

	/**
	 * List your organizations
	 * @link https://developer.github.com/v3/orgs/#list-your-organizations
	 * @return string
	 * @throws \Exception
	 */
	public function listOrganizations() {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/user/orgs')
		);
	}

	/**
	 * List user organizations
	 * @link https://developer.github.com/v3/orgs/#list-user-organizations
	 * @param string $username
	 * @return string
	 * @throws \Exception
	 */
	public function listUserOrganizations($username) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/users/:username/orgs', $username)
		);
	}

	/**
	 * Get an organization
	 * @link https://developer.github.com/v3/orgs/#get-an-organization
	 * @param string $org
	 * @return string
	 * @throws \Exception
	 */
	public function get($org) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org', $org)
		);
	}

	/**
	 * Edit an organization
	 * @link https://developer.github.com/v3/orgs/#edit-an-organization
	 * @param string $org
	 * @param string $billingEmail
	 * @param string $company
	 * @param string $email
	 * @param string $location
	 * @param string $name
	 * @param string $description
	 * @return string
	 * @throws \Exception
	 */
	public function edit($org, $billingEmail = null, $company = null, $email = null, $location = null, $name = null, $description = null) {
		return $this->getApi()->request(
			$this->getApi()->getString()->sprintf('/orgs/:org', $org),
			Request::METHOD_PATCH,
			[
				'billing_email' => $billingEmail,
				'company'       => $company,
				'email'         => $email,
				'location'      => $location,
				'name'          => $name,
				'description'   => $description
			]
		);
	}
}