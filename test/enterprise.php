<?php
require 'bootstrap.php';

// Client
$client = new \Github\Client();
//var_dump($client);

// Enterprise
$enterprise = $client->getReceiver(\GitHub\Client::ENTERPRISE);

// AdminStats
$adminStats = $activity->getReceiver(\GitHub\Receiver\Enterprise::ADMIN_STATS);
//$adminStats->getStatistics(\GitHub\AbstractApi::TYPE_ISSUES);

// License
$license = $activity->getReceiver(\GitHub\Receiver\Enterprise::LICENSE);
//$license->getLicenseInformation();

// ManagementConsole
$managementConsole = $activity->getReceiver(\GitHub\Receiver\Enterprise::MANAGEMENT_CONSOLE);
$managementConsole->setHostname('');
$managementConsole->setPassword('');
$managementConsole->upload();
$managementConsole->upgrade();
$managementConsole->checkConfigurationStatus();
$managementConsole->startConfigurationProcess();
$managementConsole->retrieveSettings();
$managementConsole->modifySettings();
$managementConsole->checkMaintenanceStatus();
$managementConsole->updateMaintenanceStatus();
$managementConsole->retrieveAuthorizedSshKeys();
$managementConsole->addNewAuthorizedSshKeys();
$managementConsole->removeAuthorizedSshKeys();

// SearchIndexing
$searchIndexing = $activity->getReceiver(\GitHub\Receiver\Enterprise::SEARCH_INDEXING);
//$searchIndexing->queueIndexingJob(':owner/:repository');
