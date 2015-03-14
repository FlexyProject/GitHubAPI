<?php
require 'bootstrap.php';

// Client
$client = new \Scion\Github\Client();
//var_dump($client);

// Activity
$activity = $client->getReceiver(\Scion\GitHub\Client::ACTIVITY);

// Events
$events = $activity->getReceiver(\Scion\GitHub\Receiver\Activity::EVENTS);
//$events->listPublicEvents();
//$events->listRepositoryEvents();
//$events->listIssueEvents();
//$events->listPublicNetworkEvents();
//$events->listPublicOrganizationEvents('organization');
//$events->listUserReceiveEvents('username');
//$events->listPublicUserReceiveEvents('username');
//$events->listUserPerformedEvents('username');
//$events->listPublicUserPerformedEvents('username');
//$events->listOrganizationEvents('username', 'organization');

// Feeds
$feeds = $activity->getReceiver(\Scion\GitHub\Receiver\Activity::FEEDS);
//$feeds->listFeeds();

// Notifications
$notifications = $activity->getReceiver(\Scion\GitHub\Receiver\Activity::NOTIFICATIONS);
//$notifications->listNotifications(false, false, 'now');
//$notifications->listRepositoryNotifications(false, false, 'now');
//$notifications->markAsRead('now');
//$notifications->markAsReadInRepository('now');
//$notifications->viewThread(1);
//$notifications->markThreadAsRead(1);
//$notifications->getThreadSubscription(1);
//$notifications->setThreadSubscription(1, false, false);
//$notifications->deleteThreadSubscription(1);

// Starring
$starring = $activity->getReceiver(\Scion\GitHub\Receiver\Activity::STARRING);
//$starring->listStargazers();
//$starring->listRepositories(\GitHub\AbstractApi::SORT_CREATED, \GitHub\AbstractApi::DIRECTION_DESC);
//$starring->checkYouAreStarringRepository();
//$starring->starRepository();
//$starring->unStarRepository();

// Watching
$watching = $activity->getReceiver(\Scion\GitHub\Receiver\Activity::WATCHING);
//$watching->listWatchers();
//$watching->listSubscriptions('username');
//$watching->getRepositorySubscription();
//$watching->setRepositorySubscription(false, false);
//$watching->deleteRepositorySubscription();
//$watching->userSubscriptions();
//$watching->watchRepository();
//$watching->stopWatchingRepository();
