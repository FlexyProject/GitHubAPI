<?php
require 'bootstrap.php';

// WebHook
$webhook = new \GitHub\WebHook();
//$webhook->getEvent('event-name');

// Payload event
$payload = $webhook->getEvent(\GitHub\WebHook::PAYLOAD);
//$payload->setSecret('your-secret');
//$payload->getRawData();
//$payload->setRawData('');
//$payload->parse();
