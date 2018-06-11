<?php
namespace FlexyProject\GitHub\Receiver\Repositories;

/**
 * The Pages API class provides access to repository's pages.
 *
 * @link    https://developer.github.com/v3/repos/pages/
 * @package FlexyProject\GitHub\Receiver\Repositories
 */
class Pages extends AbstractRepositories
{

    /**
     * Get information about a Pages site
     *
     * @link https://developer.github.com/v3/repos/pages/#get-information-about-a-pages-site
     * @return array
     */
    public function getInformation(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/pages',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo()
        ));
    }

    /**
     * List Pages builds
     *
     * @link https://developer.github.com/v3/repos/pages/#list-pages-builds
     * @return array
     */
    public function listPagesBuilds(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/pages/builds',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo()
        ));
    }

    /**
     * List latest Pages build
     *
     * @link https://developer.github.com/v3/repos/pages/#list-latest-pages-build
     * @return array
     */
    public function listLatestPagesBuilds(): array
    {
        return $this->getApi()->request($this->getApi()->sprintf(
            '/repos/:owner/:repo/pages/builds/latest',
            $this->getRepositories()->getOwner(),
            $this->getRepositories()->getRepo()
        ));
    }
}
