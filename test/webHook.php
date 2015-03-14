<?php
require 'bootstrap.php';

// WebHook
$webhook = new \Scion\GitHub\WebHook();
//$webhook->getEvent('event-name');

// Payload event
$payload = $webhook->getEvent(\Scion\GitHub\WebHook::PAYLOAD);
//$payload->setSecret('your-secret');
//$payload->getRawData();
//$payload->setRawData('');
//$payload->parse();
