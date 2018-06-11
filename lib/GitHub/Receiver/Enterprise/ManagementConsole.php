<?php
namespace FlexyProject\GitHub\Receiver\Enterprise;

use Symfony\Component\HttpFoundation\Request;

/**
 * The Management Console API helps you manage your GitHub Enterprise installation.
 *
 * @link    https://developer.github.com/v3/enterprise/management_console/
 * @package GitHub\Receiver\Enterprise
 */
class ManagementConsole extends AbstractEnterprise
{

    /** Properties */
    protected $hostname = '';
    protected $password = '';

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return ManagementConsole
     */
    public function setPassword(string $password): ManagementConsole
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get hostname
     *
     * @return string
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * Set hostname
     *
     * @param string $hostname
     *
     * @return ManagementConsole
     */
    public function setHostname(string $hostname): ManagementConsole
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * Upload a license and software package for the first time
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#upload-a-license-and-software-package-for-the-first-time
     *
     * @param string $license
     * @param string $package
     * @param string $settings
     *
     * @return array
     */
    public function upload(string $license, string $package, string $settings = ''): array
    {
        $this->getApi()->setApiUrl(sprintf('http://license:%s@%s', md5($license), $this->getHostname()));

        return $this->getApi()->request(sprintf(
            '/setup/api/start -F package=@%s -F license=@%s -F settings=<%s',
            $package,
            $license,
            $settings
        ), Request::METHOD_POST);
    }

    /**
     * Upgrade a license or software package
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#upgrade-a-license-or-software-package
     *
     * @param string $license
     * @param string $package
     *
     * @return array
     */
    public function upgrade(string $license = '', string $package = ''): array
    {
        $this->getApi()->setApiUrl(sprintf('http://license:%s@%s', md5($license), $this->getHostname()));

        return $this->getApi()->request(
            sprintf('/setup/api/upgrade -F package=@%s -F license=@%s', $package, $license),
            Request::METHOD_POST
        );
    }

    /**
     * Check configuration status
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#check-configuration-status
     * @return array
     */
    public function checkConfigurationStatus(): array
    {
        return $this->getApi()->request(sprintf('/setup/api/configcheck'));
    }

    /**
     * Start a configuration process
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#start-a-configuration-process
     * @return array
     */
    public function startConfigurationProcess(): array
    {
        return $this->getApi()->request(sprintf('/setup/api/configure'), Request::METHOD_POST);
    }

    /**
     * Retrieve settings
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#retrieve-settings
     * @return array
     */
    public function retrieveSettings(): array
    {
        return $this->getApi()->request(sprintf('/setup/api/settings'));
    }

    /**
     * Modify settings
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#modify-settings
     *
     * @param $settings
     *
     * @return array
     */
    public function modifySettings($settings): array
    {
        return $this->getApi()->request(sprintf('/setup/api/settings settings=%s', $settings), Request::METHOD_PUT);
    }

    /**
     * Check maintenance status
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#check-maintenance-status
     * @return array
     */
    public function checkMaintenanceStatus(): array
    {
        return $this->getApi()->request(sprintf('/setup/api/maintenance'));
    }

    /**
     * Enable or disable maintenance mode
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#enable-or-disable-maintenance-mode
     *
     * @param string $maintenance
     *
     * @return array
     */
    public function updateMaintenanceStatus(string $maintenance): array
    {
        return $this->getApi()->request(
            sprintf('/setup/api/maintenance -d maintenance=%s', $maintenance),
            Request::METHOD_POST
        );
    }

    /**
     * Retrieve authorized SSH keys
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#retrieve-authorized-ssh-keys
     * @return array
     */
    public function retrieveAuthorizedSshKeys(): array
    {
        return $this->getApi()->request(sprintf('/setup/api/settings/authorized-keys'));
    }

    /**
     * Add a new authorized SSH key
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#add-a-new-authorized-ssh-key
     *
     * @param string $authorizedKey
     *
     * @return array
     */
    public function addNewAuthorizedSshKeys(string $authorizedKey): array
    {
        return $this->getApi()->request(sprintf(
            '/setup/api/settings/authorized-keys -F authorized_key=@%s',
            $authorizedKey
        ), Request::METHOD_POST);
    }

    /**
     * Remove an authorized SSH key
     *
     * @link https://developer.github.com/v3/enterprise/management_console/#remove-an-authorized-ssh-key
     *
     * @param string $authorizedKey
     *
     * @return array
     */
    public function removeAuthorizedSshKeys(string $authorizedKey): array
    {
        return $this->getApi()->request(sprintf(
            '/setup/api/settings/authorized-keys -F authorized_key=@%s',
            $authorizedKey
        ), Request::METHOD_DELETE);
    }
}
