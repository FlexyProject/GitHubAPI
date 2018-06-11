<?php
namespace FlexyProject\GitHub\Tests;

use FlexyProject\GitHub\Event\Payload;
use FlexyProject\GitHub\WebHook;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractWebHookTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class AbstractWebHookTest extends TestCase
{
    /** @var  WebHook */
    protected $webHook;

    /** @var Payload */
    protected $payload;

    /**
     * WebHookTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        // Create a WebHook object
        $this->webHook = new WebHook();

        // Create a Payload object
        $this->payload = $this->webHook->getEvent(WebHook::PAYLOAD);

        parent::__construct($name, $data, $dataName);
    }
}
