<?php
namespace Scion\Services\GitHub\Receiver\Enterprise;

use Scion\Http\Request;

/**
 * Class ManagementConsole
 * @see     https://developer.github.com/v3/enterprise/management_console/
 * @package Scion\Services\GitHub\Receiver\Enterprise
 */
class ManagementConsole extends AbstractEnterprise {

	/** Protected properties */
	protected $hostname;
	protected $password;

	/**
	 * Get password
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set password
	 * @param mixed $password
	 * @return ManagementConsole
	 */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get hostname
	 * @return mixed
	 */
	public function getHostname() {
		return $this->hostname;
	}

	/**
	 * Set hostname
	 * @param mixed $hostname
	 * @return ManagementConsole
	 */
	public function setHostname($hostname) {
		$this->hostname = $hostname;

		return $this;
	}

	/**
	 * Upload a license and software package for the first time
	 * @see https://developer.github.com/v3/enterprise/management_console/#upload-a-license-and-software-package-for-the-first-time
	 * @param string $license
	 * @param string $package
	 * @param string $settings
	 * @return mixed
	 */
	public function upload($license, $package, $settings = '') {
		$this->api->setApiUrl(sprintf('http://license:%s@%s', md5($license), $this->getHostname()));

		return $this->api->request(
			sprintf('/setup/api/start -F package=@%s -F license=@%s -F settings=<%s', $package, $license, $settings),
			Request::METHOD_POST
		);
	}

	/**
	 * Upgrade a license or software package
	 * @see https://developer.github.com/v3/enterprise/management_console/#upgrade-a-license-or-software-package
	 * @param string $license
	 * @param string $package
	 * @return mixed
	 */
	public function upgrade($license = '', $package = '') {
		$this->api->setApiUrl(sprintf('http://license:%s@%s', md5($license), $this->getHostname()));

		return $this->api->request(
			sprintf('/setup/api/upgrade -F package=@%s -F license=@%s', $package, $license),
			Request::METHOD_POST
		);
	}

	/**
	 * Check configuration status
	 * @see https://developer.github.com/v3/enterprise/management_console/#check-configuration-status
	 * @return mixed
	 */
	public function checkConfigurationStatus() {
		return $this->api->request(
			sprintf('/setup/api/configcheck')
		);
	}

	public function startConfigurationProcess() {
		return $this->api->request(
			sprintf('/setup/api/configure'),
			Request::METHOD_POST
		);
	}

	public function retrieveSettings() {
		return $this->api->request(
			sprintf('/setup/api/settings')
		);
	}

	public function modifySettings($settings) {
		return $this->api->request(
			sprintf('/setup/api/settings'),
			Request::METHOD_PUT
		);
	}

	public function checkMaintenanceStatus() {
		return $this->api->request(
			sprintf('/setup/api/maintenance')
		);
	}

	public function updateMaintenanceStatus($maintenance) {
		return $this->api->request(
			sprintf('/setup/api/maintenance'),
			Request::METHOD_POST
		);
	}

	public function retrieveAuthorizedSshKeys() {
		return $this->api->request(
			sprintf('/setup/api/settings/authorized-keys')
		);
	}

	public function addNewAuthorizedSshKeys($authorizedKey) {
		return $this->api->request(
			sprintf(' /setup/api/settings/authorized-keys'),
			Request::METHOD_POST
		);
	}

	public function removeAuthorizedSshKeys($authorizedKey) {
		return $this->api->request(
			sprintf('/setup/api/settings/authorized-keys'),
			Request::METHOD_DELETE
		);
	}
} 