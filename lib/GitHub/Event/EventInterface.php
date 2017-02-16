<?php
namespace FlexyProject\GitHub\Event;

use FlexyProject\GitHub\WebHook;

/**
 * Interface EventInterface
 *
 * @package FlexyProject\GitHub\Event
 */
interface EventInterface
{

    /**
     * Constructor, pass a WebHook object
     *
     * @param WebHook $webHook
     */
    public function __construct(WebHook $webHook);

    /**
     * Parse raw data
     *
     * @return Payload
     */
    public function parse(): Payload;
}