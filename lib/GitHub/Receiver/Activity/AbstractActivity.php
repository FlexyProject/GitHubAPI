<?php
namespace FlexyProject\GitHub\Receiver\Activity;

use FlexyProject\GitHub\AbstractApi;
use FlexyProject\GitHub\Receiver\Activity;
use FlexyProject\GitHub\Receiver\Api;

/**
 * Class AbstractActivity
 *
 * @package FlexyProject\GitHub\Receiver\Activity
 */
abstract class AbstractActivity
{
    /** Api trait */
    use Api;

    /** Properties */
    protected $activity;

    /**
     * Constructor
     *
     * @param Activity $activity
     */
    public function __construct(Activity $activity)
    {
        $this->setActivity($activity);
        $this->setApi($activity->getApi());
    }

    /**
     * Get activity
     *
     * @return Activity
     */
    public function getActivity(): Activity
    {
        return $this->activity;
    }

    /**
     * Set activity
     *
     * @param Activity $activity
     *
     * @return AbstractActivity
     */
    public function setActivity(Activity $activity): AbstractActivity
    {
        $this->activity = $activity;

        return $this;
    }
}
