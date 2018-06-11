<?php
namespace FlexyProject\GitHub\Receiver\Miscellaneous;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Api;
use FlexyProject\GitHub\Receiver\Miscellaneous;

/**
 * Class AbstractMiscellaneous
 *
 * @package FlexyProject\GitHub\Receiver\Miscellaneous
 */
abstract class AbstractMiscellaneous
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $miscellaneous;

    /**
     * Constructor
     *
     * @param Miscellaneous $miscellaneous
     */
    public function __construct(Miscellaneous $miscellaneous)
    {
        $this->setMiscellaneous($miscellaneous);
        $this->setApi($miscellaneous->getApi());
    }

    /**
     * Get miscellaneous
     *
     * @return Miscellaneous
     */
    public function getMiscellaneous(): Miscellaneous
    {
        return $this->miscellaneous;
    }

    /**
     * Set miscellaneous
     *
     * @param Miscellaneous $miscellaneous
     *
     * @return AbstractMiscellaneous
     */
    public function setMiscellaneous(Miscellaneous $miscellaneous): AbstractMiscellaneous
    {
        $this->miscellaneous = $miscellaneous;

        return $this;
    }
}
