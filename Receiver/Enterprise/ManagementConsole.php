<?php
namespace Scion\Services\GitHub\Receiver\Enterprise;

use Scion\Http\Request;

/**
 * Class ManagementConsole
 * @see     https://developer.github.com/v3/enterprise/management_console/
 * @package Scion\Services\GitHub\Receiver\Enterprise
 */
class ManagementConsole extends AbstractEnterprise {

	public function upload($license, $package, $settings = '') {
		return $this->api->request(
			sprintf('/setup/api/start -F package=@%s -F license=@%s -F settings=<%s', $package, $license, $settings),
			Request::METHOD_POST,
			'http://license:md5-checksum-of-license@hostname'
		);
	}

	public function upgrade($license = '', $package = '') {
		return $this->api->request(
			sprintf('/setup/api/upgrade'),
			Request::METHOD_POST,
			'http://license:md5-checksum-of-license@hostname'
		);
	}

	public function checkConfigurationStatus() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function startConfigurationProcess() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function retrieveSettings() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function modifySettings() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function checkMaintenanceStatus() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function updateMaintenanceStatus() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function retrieveAuthorizedSshKeys() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function addNewAuthorizedSshKeys() {
		return $this->api->request(
			sprintf('')
		);
	}

	public function removeAuthorizedSshKeys() {
		return $this->api->request(
			sprintf('')
		);
	}
} 