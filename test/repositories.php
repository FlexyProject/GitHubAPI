<?php
require 'bootstrap.php';

// Client
$client = new \Scion\Github\Client();

// Repositories
/** @return \Scion\GitHub\Receiver\Repositories */
$repositories = $client->getReceiver(\Scion\GitHub\Client::REPOSITORIES);
//$repositories->getOwner();
//$repositories->setOwner('owner name');
//$repositories->getRepo();
//$repositories->setRepo('repo name');
//$repositories->listYourRepositories();
//$repositories->listUserRepositories('username');
//$repositories->listOrganizationRepositories('organization');
//$repositories->listPublicRepositories();
//$repositories->createRepository('testAPI', 'test GitHub API');
//$repositories->createOrganizationRepository('organization');
//$repositories->get();
//$repositories->edit();
//$repositories->listContributors();
//$repositories->listLanguages();
//$repositories->listTeams();
//$repositories->listTags();
//$repositories->listBranches();
//$repositories->getBranch(\GitHub\Client::BRANCH_DEVELOP);
//$repositories->deleteRepository();

// Repositories\Collaborators
$collaborators = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::COLLABORATORS);
//$collaborators->listCollaborators();
//$collaborators->checkUserIsACollaborator('username');
//$collaborators->addUserAsCollaborator('username');
//$collaborators->removeUserAsCollaborator('username');

// Repositories\Comments
$comments = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::COMMENTS);
//$comments->listComments();
//$comments->listCommitComments(\GitHub\AbstractApi::BRANCH_MASTER);
//$comments->addCommitComment('6dcb09b5b57875f334f61aebed695e2e4193db5e', 'Nice change', 'file1.txt', 4);
//$comments->getCommitComment(1);
//$comments->updateCommitComment(1);
//$comments->deleteCommitComment(1);

// Repositories\Commits
$commits = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::COMMITS);
//$commits->listCommits();
//$commits->getSingleCommit('6dcb09b5b57875f334f61aebed695e2e4193db5e');
//$commits->compareTwoCommits('master', 'topic');
//$commits->compareTwoCommits('user1:branchname', 'user2:branchname');

// Repositories\Contents
$contents = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::CONTENTS);
//$contents->getReadme();
//$contents->getContents();
//$contents->createFile('notes/hello.txt', 'my commit message', 'bXkgbmV3IGZpbGUgY29udGVudHM=');
//$contents->updateFile('notes/hello.txt', 'my commit message', 'bXkgbmV3IGZpbGUgY29udGVudHM=', '95b966ae1c166bd92f8ae7d1c313e738c731dfc3');
//$contents->deleteFile('notes/hello.txt', 'my commit message', '95b966ae1c166bd92f8ae7d1c313e738c731dfc3');
//$contents->getArchiveLink();

// Repositories\DeployKeys
$deploy_keys = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::DEPLOY_KEYS);
//$deploy_keys->listDeployKeys();
//$deploy_keys->getDeployKey(1);
//$deploy_keys->addNewDeployKey('octocat@octomac', 'ssh-rsa AAA...');
//$deploy_keys->removeDeployKey(1);

// Repositories\Deployments
$deployments = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::DEPLOYMENTS);
//$deployments->listDeployments('a84d88e7554fc1fa21bcbc4efae3c782a70d2b9d', \GitHub\AbstractApi::BRANCH_MASTER, 'deploy', 'production');
//$deployments->createDeployement(\GitHub\AbstractApi::BRANCH_MASTER, 'deploy', true, ["ci/janky","security/brakeman"], '{"task": "deploy:migrate"}', 'production', 'Deploy request from hubot');
//$deployments->listDeploymentStatus(1);
//$deployments->createDeploymentStatus(1, 'success', 'https://example.com/deployment/42/output', 'Deployment finished successfully.');

// Repositories\Forks
$forks = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::FORKS);
//$forks->listForks($sort = \Scion\GitHub\Receiver\Repositories\Forks::SORT_STARGAZERS);
//$forks->createFork('organization-login');

// Repositories\Hooks
$hooks = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::HOOKS);
//$hooks->listHooks();
//$hooks->getSingleHook(1);
//$hooks->createHook('web', '{"url": "http://example.com/webhook","content_type": "json"}', ["push", "pull_request"], true);
//$hooks->editHook(1, '', [], ["pull_request"], [], true);
//$hooks->testPushHook(1);
//$hooks->ingHook(1);
//$hooks->deleteHook(1);

// Repositories\Merging
$merging = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::MERGING);
//$merging->performMerge('master', 'cool_feature', 'Shipped cool_feature!');

// Repositories\Pages
$pages = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::PAGES);
//$pages->getInformation();
//$pages->listPagesBuilds();
//$pages->listLatestPagesBuilds();

// Repositories\Releases
$releases = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::RELEASES);
//$releases->listReleases();
//$releases->getSingleRelease(1);
//$releases->createRelease('v1.0.0', \Scion\GitHub\AbstractApi::BRANCH_MASTER, 'v1.0.0', 'Description of the release', false, false);
//$releases->editRelease(1, 'v1.0.0', \Scion\GitHub\AbstractApi::BRANCH_MASTER, 'v1.0.0', 'Description of the release', false, false);
//$releases->deleteRelease(1);
//$releases->getReleaseAssets(1);
//$releases->uploadReleaseAsset(1, 'application/zip', 'foo.zip');
//$releases->getSingleReleaseAsset(1);
//$releases->editReleaseAsset(1, 'foo-1.0.0-osx.zip', 'Mac binary');
//$releases->deleteReleaseAsset(1);

// Repositories\Statistics
$statistics = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::STATISTICS);
//$statistics->listContributors();
//$statistics->getCommitActivity();
//$statistics->getCodeFrequency();
//$statistics->getParticipation();
//$statistics->getPunchCard();

// Repositories\Statuses
$statuses = $repositories->getReceiver(\Scion\GitHub\Receiver\Repositories::STATUSES);
//$statuses->createStatus('6dcb09b5b57875f334f61aebed695e2e4193db5e', \GitHub\Receiver\Repositories\Statuses::STATE_SUCCESS, 'https://example.com/build/status', 'The build succeeded!', 'continuous-integration/jenkins');
//$statuses->listStatuses('master');
//$statuses->getCombinedStatus('master');
