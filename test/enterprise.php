<?php
require 'bootstrap.php';

// Client
$client = new \Scion\Github\Client();
//var_dump($client);

// Enterprise
$enterprise = $client->getReceiver(\Scion\GitHub\Client::ENTERPRISE);

// AdminStats
$adminStats = $activity->getReceiver(\Scion\GitHub\Receiver\Enterprise::ADMIN_STATS);
//$adminStats->getStatistics(\GitHub\AbstractApi::TYPE_ISSUES);

// License
$license = $activity->getReceiver(\Scion\GitHub\Receiver\Enterprise::LICENSE);
//$license->getLicenseInformation();

// ManagementConsole
$managementConsole = $activity->getReceiver(\Scion\GitHub\Receiver\Enterprise::MANAGEMENT_CONSOLE);
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
$searchIndexing = $activity->getReceiver(\Scion\GitHub\Receiver\Enterprise::SEARCH_INDEXING);
//$searchIndexing->queueIndexingJob(':owner/:repository');
