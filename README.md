# GitHub API
This is a Client and WebHook wrapper for [GitHub API v3](http://developer.github.com/v3/), written with PHP5.  
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/?branch=develop)
[![Build Status](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/build-status/develop)

## Requirements
* PHP >= 5.6.1

## Dependencies
* \Scion\Crypt
* \Scion\File
* \Scion\Http
* \Scion\Mvc
* \Scion\Stdlib

## Quick Start
```php
// Create a client object
$client = new \Github\Client();

// Miscellaneous
$miscellaneous = $client->getReceiver(\GitHub\Client::MISCELLANEOUS);

// Lists all the emojis available to use on GitHub.
$emojis = $miscellaneous->getReceiver(\GitHub\Receiver\Miscellaneous::EMOJIS);
$emojis->get();
```

## License
The files in this archive are released under the [GNU Lesser GPL v3](https://github.com/Scion-Framework/scion-core/blob/develop/LICENSE) license.
