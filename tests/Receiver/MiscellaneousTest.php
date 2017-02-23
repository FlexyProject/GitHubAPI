<?php
namespace FlexyProject\GitHub\Tests\Receiver;

use FlexyProject\GitHub\{
    Client, Receiver\Miscellaneous, Tests\AbstractClientTest
};

/**
 * Class MiscellaneousTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class MiscellaneousTest extends AbstractClientTest
{

    /** @var Miscellaneous */
    protected $miscellaneous;

    /** @var Miscellaneous\Emojis */
    protected $emojis;

    /** @var  Miscellaneous\Gitignore */
    protected $gitIgnore;

    /** @var  Miscellaneous\Licenses */
    protected $licenses;

    /** @var  Miscellaneous\Markdown */
    protected $markdown;

    /** @var  Miscellaneous\Meta */
    protected $meta;

    /** @var  Miscellaneous\RateLimit */
    protected $rateLimit;

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

        // Emojis
        $this->emojis = $this->miscellaneous->getReceiver(Miscellaneous::EMOJIS);

        // GitIgnore
        $this->gitIgnore = $this->miscellaneous->getReceiver(Miscellaneous::GITIGNORE);

        // Licenses
        $this->licenses = $this->miscellaneous->getReceiver(Miscellaneous::LICENSES);

        // Markdown
        $this->markdown = $this->miscellaneous->getReceiver(Miscellaneous::MARKDOWN);

        // Meta
        $this->meta = $this->miscellaneous->getReceiver(Miscellaneous::META);

        // RateLimit
        $this->rateLimit = $this->miscellaneous->getReceiver(Miscellaneous::RATE_LIMIT);
    }

    /**
     * Test list available Emojis
     */
    public function testGetListEmojis()
    {
        $this->assertCount(1508, $this->emojis->get());
    }

    /**
     * Test listing available templates
     */
    public function testListingAvailableTemplates()
    {
        $templates = $this->gitIgnore->listingAvailableTemplates();

        $this->assertContains('Android', $templates);
    }

    /**
     * Test getting a single template
     */
    public function testGetSingleTemplate()
    {
        $template = $this->gitIgnore->getSingleTemplate('Android');

        $this->assertArrayHasKey('name', $template);
        $this->assertArrayHasKey('source', $template);
    }

    /**
     * Test listing all licenses
     */
    public function testListAllLicenses()
    {
        $licenses = $this->licenses->listAllLicenses();
        $license  = array_pop($licenses);

        $this->assertArrayHasKey('key', $license);
        $this->assertArrayHasKey('name', $license);
        $this->assertArrayHasKey('spdx_id', $license);
        $this->assertArrayHasKey('url', $license);
        $this->assertArrayHasKey('featured', $license);
    }

    /**
     * Test getting individual license
     */
    public function testGettingIndividualLicense()
    {
        $license = $this->licenses->getIndividualLicense('mit');

        $this->assertArrayHasKey('body', $license);
    }

    /**
     * Test render markdown text
     */
    public function testRender()
    {
        $output = $this->markdown->render('Hello world FlexyProject/GitHubAPI#43 **cool**, and #43!');

        $this->assertEquals('<p>Hello world FlexyProject/GitHubAPI#43 <strong>cool</strong>, and #43!</p>',
            str_replace(["\r\n", "\r", "\n"], "", $output[0]));
    }

    /**
     * Test render markdown raw text
     */
    public function testRenderRaw()
    {
        $output = $this->markdown->renderRaw('**cool**');

        $this->assertEquals('<p>{"file":"<strong>cool</strong>"}</p>',
            str_replace(["\r\n", "\r", "\n"], "", $output[0]));
    }

    /**
     * Test getting meta about GitHub.com
     */
    public function testGetMeta()
    {
        $meta = $this->meta->get();

        $this->assertTrue($meta['verifiable_password_authentication']);
    }

    /**
     * Test rate limit
     */
    public function testRateLimit()
    {
        $rateLimit = $this->rateLimit->get();

        $this->assertArrayHasKey('rate', $rateLimit);
    }
}