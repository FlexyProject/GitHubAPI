<?php
namespace FlexyProject\GitHub\Receiver\GitData;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\GitData;

/**
 * Class AbstractGitData
 *
 * @package FlexyProject\GitHub\Receiver\GitData
 */
abstract class AbstractGitData
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $gitData;

    /**
     * Constructor
     *
     * @param GitData $gitData
     */
    public function __construct(GitData $gitData)
    {
        $this->setGitData($gitData);
        $this->setApi($gitData->getApi());
    }

    /**
     * Get gitData
     *
     * @return GitData
     */
    public function getGitData(): GitData
    {
        return $this->gitData;
    }

    /**
     * Set gitData
     *
     * @param GitData $gitData
     *
     * @return AbstractGitData
     */
    public function setGitData(GitData $gitData): AbstractGitData
    {
        $this->gitData = $gitData;

        return $this;
    }
}