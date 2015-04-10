<?php
require 'bootstrap.php';

// Client
$client = new \Scion\Github\Client();
//$client->getApiUrl();
//$client->setApiUrl('');
//$client->getClientId();
//$client->setClientId('');
//$client->getClientSecret();
//$client->setClientSecret('');
//$client->getHttpAuth();
//$client->setHttpAuth('', '');
//$client->getToken();
//$client->request('');
//var_dump($client);

// Miscellaneous
$miscellaneous = $client->getReceiver(\Scion\GitHub\Client::MISCELLANEOUS);
// Lists all the emojis available to use on GitHub.
//$emojis = $miscellaneous->getReceiver(\Scion\GitHub\Receiver\Miscellaneous::EMOJIS);
//var_dump($emojis->get());