<?php
require 'bootstrap.php';

// Client
$client = new \Scion\Github\Client();
//var_dump($client);

// GitData
$gitData = $client->getReceiver(\Scion\GitHub\Client::GIT_DATA);

// Blobs
$blobs = $gitData->getReceiver(\Scion\GitHub\Receiver\GitData::BLOBS);
//$blobs->getBlob('3a0f86fb8db8eea7ccbb9a95f325ddbedfb25e15');
//$blobs->createBlob('Content of the blob', 'utf-8');


