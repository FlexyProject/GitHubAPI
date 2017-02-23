<?php
namespace FlexyProject\GitHub\Tests;

use FlexyProject\GitHub\Event\Payload;
use FlexyProject\GitHub\WebHook;

/**
 * Class WebHookTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class WebHookTest extends AbstractWebHookTest
{
    /**
     * Test instance of WebHook's class
     */
    public function testWebHook()
    {
        $this->assertInstanceOf(WebHook::class, $this->webHook);
    }

    /**
     * Test instance of Payload's class
     */
    public function testPayload()
    {
        $this->assertInstanceOf(Payload::class, $this->payload);
    }
}