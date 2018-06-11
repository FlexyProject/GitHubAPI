<?php
namespace FlexyProject\GitHub\Tests\Event;

use FlexyProject\GitHub\Tests\AbstractWebHookTest;

/**
 * Class PayloadTest
 *
 * @package FlexyProject\GitHub\Tests\Event
 */
class PayloadTest extends AbstractWebHookTest
{
    /**
     * Test setting a secret
     */
    public function testSecret()
    {
        $this->payload->setSecret('your-secret');

        $this->assertEquals(
            hash_hmac('sha1', $this->payload->getRawData(), 'your-secret'),
            $this->payload->getSecret()
        );
    }
}
