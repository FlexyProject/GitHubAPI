<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

/**
 * The Licenses API class returns information about open source licenses or under what license, if any a given project
 * is distributed.
 *
 * @link    https://developer.github.com/v3/licenses/
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
class Licenses extends AbstractMiscellaneous
{

    /**
     * List all licenses
     *
     * @link https://developer.github.com/v3/licenses/#list-all-licenses
     * @return array
     */
    public function listAllLicenses(): array
    {
        return $this->getApi()->setAccept('application/vnd.github.drax-preview+json')->request('/licenses');
    }

    /**
     * Get an individual license
     *
     * @link https://developer.github.com/v3/licenses/#get-an-individual-license
     *
     * @param string $license
     *
     * @return array
     */
    public function getIndividualLicense(string $license): array
    {
        return $this->getApi()->setAccept('application/vnd.github.drax-preview+json')->request($this->getApi()
                                                                                                    ->sprintf('/licenses/:license',
                                                                                                        $license));
    }
}