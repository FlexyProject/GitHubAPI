<?php
namespace FlexyProject\GitHub\Tests;

use FlexyProject\GitHub\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 *
 * @package FlexyProject\GitHub\Tests
 */
abstract class AbstractClientTest extends TestCase
{
    /** @var Client */
    protected $client;

    /**
     * AbstractTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        // Create a client object
        $this->client = new Client();

        // Set auth credentials
        $this->client->setHttpAuth($GLOBALS['USERNAME'], $GLOBALS['PASSWORD']);

        parent::__construct($name, $data, $dataName);
    }
}
