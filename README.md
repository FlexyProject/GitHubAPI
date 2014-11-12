# Services\GitHub component for Scion-Framework
This is the Services\GitHub component for Scion-Framework.

## Requirements
* PHP >= 5.6.1
* Scion-Framework

## Dependencies
* \Scion\Crypt
* \Scion\File
* \Scion\Http
* \Scion\Mvc
* \Scion\Stdlib

## Documentation
Documentation is hosted at [http://scion.justdavid.me](http://scion.justdavid.me)

## Quick Start
```php
// Create a client object
$client = new \Scion\Services\Github\Client();

// Miscellaneous
$miscellaneous = $client->getReceiver(\Scion\Services\GitHub\Client::MISCELLANEOUS);

// Lists all the emojis available to use on GitHub.
$emojis = $miscellaneous->getReceiver(\Scion\Services\GitHub\Receiver\Miscellaneous::EMOJIS);
$emojis->get();
```

## License
The files in this archive are released under the [GNU Lesser GPL v3](LICENSE) license.
