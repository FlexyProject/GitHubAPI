<?php
namespace FlexyProject\GitHub\Tests\Receiver;

use FlexyProject\GitHub\{
    Client, Receiver\Miscellaneous, Tests\AbstractTest
};

/**
 * Class MiscellaneousTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class MiscellaneousTest extends AbstractTest
{

    /** @var Miscellaneous */
    protected $miscellaneous;

    /**
     * MiscellaneousTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Miscellaneous
        $this->miscellaneous = $this->client->getReceiver(Client::MISCELLANEOUS);
    }

    /**
     * Test list available Emojis
     */
    public function testGetListEmojis()
    {
        /** @var Miscellaneous\Emojis $emojis */
        $emojis = $this->miscellaneous->getReceiver(Miscellaneous::EMOJIS);

        $this->assertEquals(1508, count($emojis->get()));
    }
}