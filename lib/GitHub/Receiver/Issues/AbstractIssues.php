<?php
namespace FlexyProject\GitHub\Receiver\Issues;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Issues;

/**
 * Class AbstractIssues
 *
 * @package FlexyProject\GitHub\Receiver\Issues
 */
abstract class AbstractIssues
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $issues;

    /**
     * Constructor
     *
     * @param Issues $issues
     */
    public function __construct(Issues $issues)
    {
        $this->setIssues($issues);
        $this->setApi($issues->getApi());
    }

    /**
     * Get issues
     *
     * @return Issues
     */
    public function getIssues(): Issues
    {
        return $this->issues;
    }

    /**
     * Set issues
     *
     * @param Issues $issues
     *
     * @return AbstractIssues
     */
    public function setIssues(Issues $issues): AbstractIssues
    {
        $this->issues = $issues;

        return $this;
    }
}
