<?php
require 'bootstrap.php';

// Client
$client = new \Github\Client();
//var_dump($client);

// Gists
$gists = $client->getReceiver(\GitHub\Client::GISTS);
//$gists->listGists('username');
//$gists->listPublicGists();
//$gists->listUsersStarredGists();
//$gists->getGist(1);
//$gists->createGist('{"file1.txt": {"content": "String file contents"}', 'the description for this gist', true);
//$gists->editGist(1, 'the description for this gist', '{"file1.txt": {"content": "String file contents"}', 'content', 'file.name');
//$gists->listGistsCommits(1);
//$gists->starGist(1);
//$gists->unStarGist(1);
//$gists->checkGistIsStarred(1);
//$gists->forkGist(1);
//$gists->listGistForks(1);
//$gists->deleteGist(1);

// Comments
$comments = $gists->getReceiver(\GitHub\Receiver\Gists::COMMENTS);
//$comments->listComments(1);
//$comments->getSingleComment(1, 1);
//$comments->createComment(1, 'Just commenting for the sake of commenting');
//$comments->editComment(1, 1, 'Just commenting for the sake of commenting');
//$comments->deleteComment(1, 1);
