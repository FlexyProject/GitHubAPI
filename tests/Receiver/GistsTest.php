<?php
namespace FlexyProject\GitHub\Tests\Receiver;

use FlexyProject\GitHub\{
    Client, Receiver\Gists, Tests\AbstractClientTest
};

/**
 * Class GistsTest
 *
 * @package FlexyProject\GitHub\Tests
 */
class GistsTest extends AbstractClientTest
{
    /** Public test gist ID */
    const PUBLIC_GIST = '76e253825bb3c6c084cf31f92997eb72';

    /** @var Gists */
    protected $gists;

    /** @var Gists\Comments */
    protected $comments;

    /**
     * GistsTest constructor.
     *
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Gists
        $this->gists = $this->client->getReceiver(Client::GISTS);

        // Comments
        $this->comments = $this->gists->getReceiver(Gists::COMMENTS);
    }

    /**
     * Test list gists of current users
     */
    public function testListGists()
    {
        $gists = $this->gists->listGists();
        if (!empty($gists)) {
            $gist = array_pop($gists);

            $this->assertArrayHasKey('url', $gist);
            $this->assertArrayHasKey('files', $gist);
            $this->assertArrayHasKey('comments', $gist);
            $this->assertArrayHasKey('created_at', $gist);
            $this->assertArrayHasKey('updated_at', $gist);
            $this->assertArrayHasKey('user', $gist);
        }
    }

    /**
     * Test list public gists
     */
    public function testPublicListGists()
    {
        $gists = $this->gists->listPublicGists();
        if (!empty($gists)) {
            $gist = array_pop($gists);

            $this->assertArrayHasKey('url', $gist);
            $this->assertArrayHasKey('files', $gist);
            $this->assertArrayHasKey('comments', $gist);
            $this->assertArrayHasKey('created_at', $gist);
            $this->assertArrayHasKey('updated_at', $gist);
            $this->assertArrayHasKey('user', $gist);
        }
    }

    /**
     * Test list user's starred gists
     */
    public function testListUsersStarredGists()
    {
        $gists = $this->gists->listUsersStarredGists();
        if (!empty($gists)) {
            $gist = array_pop($gists);

            $this->assertArrayHasKey('url', $gist);
            $this->assertArrayHasKey('files', $gist);
            $this->assertArrayHasKey('comments', $gist);
            $this->assertArrayHasKey('created_at', $gist);
            $this->assertArrayHasKey('updated_at', $gist);
            $this->assertArrayHasKey('user', $gist);
        }
    }

    /**
     * Test creating a new gist
     *
     * @return string
     */
    public function testCreateGist(): string
    {
        $gist = $this->gists->createGist([
            md5('phpunit-testing') . '.txt' => [
                'content' => 'String file contents'
            ]
        ], 'the description for this gist');

        $this->assertArrayHasKey('url', $gist);
        $this->assertArrayHasKey('files', $gist);
        $this->assertArrayHasKey('comments', $gist);
        $this->assertArrayHasKey('created_at', $gist);
        $this->assertArrayHasKey('updated_at', $gist);
        $this->assertArrayHasKey('user', $gist);

        return $gist['id'];
    }

    /**
     * Test getting gist by ID
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testGetGistById(string $gistId)
    {
        $gist = $this->gists->getGist($gistId);

        $this->assertArrayHasKey('url', $gist);
        $this->assertArrayHasKey('files', $gist);
        $this->assertArrayHasKey('comments', $gist);
        $this->assertArrayHasKey('created_at', $gist);
        $this->assertArrayHasKey('updated_at', $gist);
        $this->assertArrayHasKey('user', $gist);
    }

    /**
     * Test updating an existing gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testUpdateGist(string $gistId)
    {
        $gist = $this->gists->editGist($gistId, 'the description UPDATED for this gist', [
            md5('phpunit-testing') . '.txt' => [
                'content' => 'String file contents'
            ]
        ], 'content', 'renamed-file.name');

        $this->assertEquals('the description UPDATED for this gist', $gist['description']);
    }

    /**
     * Test list commits of a gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testListGistsCommit(string $gistId)
    {
        $gists = $this->gists->listGistsCommits($gistId);
        $gist  = array_pop($gists);

        $this->assertArrayHasKey('user', $gist);
        $this->assertArrayHasKey('version', $gist);
        $this->assertArrayHasKey('committed_at', $gist);
        $this->assertArrayHasKey('change_status', $gist);
        $this->assertArrayHasKey('url', $gist);
    }

    /**
     * Test starring a gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testStarGist(string $gistId)
    {
        $this->assertTrue($this->gists->starGist($gistId));
    }

    /**
     * Test gist is starred
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testGistIsStarred(string $gistId)
    {
        $this->assertTrue($this->gists->checkGistIsStarred($gistId));
    }

    /**
     * Test unstar a gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testUnStarGist(string $gistId)
    {
        $this->assertTrue($this->gists->unStarGist($gistId));
    }

    /**
     * Test fork a public gist
     */
    public function testForkGist()
    {
        $gist = $this->gists->forkGist(self::PUBLIC_GIST);

        $this->assertArrayHasKey('forks_url', $gist);

        return $gist['id'];
    }

    /**
     * Test list forks of a specific gist
     */
    public function testListGistForks()
    {
        $gists = $this->gists->listGistForks(self::PUBLIC_GIST);
        $gist  = array_pop($gists);

        $this->assertArrayHasKey('url', $gist);
        $this->assertArrayHasKey('id', $gist);
    }

    /**
     * Test deleting a forked gist
     *
     * @depends testForkGist
     *
     * @param string $gistId
     */
    public function testDeleteForkedGist(string $gistId)
    {
        $this->assertTrue($this->gists->deleteGist($gistId));
    }

    /**
     * Test create a new comment in specific gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testCreateComment(string $gistId)
    {
        $response = $this->comments->createComment($gistId, 'Just commenting for the sake of commenting');

        $this->assertEquals('Just commenting for the sake of commenting', $response['body']);

        return $response['id'];
    }

    /**
     * Test listing all comments for specific gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testListComments(string $gistId)
    {
        $comments = $this->comments->listComments($gistId);
        $comment  = array_pop($comments);

        $this->assertArrayHasKey('id', $comment);
        $this->assertArrayHasKey('url', $comment);
        $this->assertArrayHasKey('body', $comment);
    }

    /**
     * Test getting a single comment
     *
     * @depends testCreateGist
     * @depends testCreateComment
     *
     * @param string $gistId
     * @param string $commentId
     */
    public function testGetSingleComment(string $gistId, string $commentId)
    {
        $response = $this->comments->getSingleComment($gistId, $commentId);

        $this->assertEquals('Just commenting for the sake of commenting', $response['body']);
    }

    /**
     * Test editing a gist's comment
     *
     * @depends testCreateGist
     * @depends testCreateComment
     *
     * @param string $gistId
     * @param string $commentId
     */
    public function testEditComment(string $gistId, string $commentId)
    {
        $response = $this->comments->editComment($gistId, $commentId, 'Just editing this comment!');

        $this->assertEquals('Just editing this comment!', $response['body']);
    }

    /**
     * Test deleting a comment
     *
     * @depends testCreateGist
     * @depends testCreateComment
     *
     * @param string $gistId
     * @param string $commentId
     */
    public function testDeleteComment(string $gistId, string $commentId)
    {
        $this->assertTrue($this->comments->deleteComment($gistId, $commentId));
    }

    /**
     * Test deleting an existing gist
     *
     * @depends testCreateGist
     *
     * @param string $gistId
     */
    public function testDeleteGist(string $gistId)
    {
        $this->assertTrue($this->gists->deleteGist($gistId));
    }

}