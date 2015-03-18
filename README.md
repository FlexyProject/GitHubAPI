# Scion: Wrapper for GitHub API v3
This is a Client and WebHook wrapper for [GitHub API v3](http://developer.github.com/v3/), written with PHP5.  
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/?branch=develop)
[![Build Status](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/build-status/develop)

## Requirements
* PHP >= 5.6.1
* [cURL](http://php.net/manual/en/book.curl.php) extension

## Dependencies
* [scion/crypt](https://github.com/Scion-Framework/Crypt)
* [scion/file](https://github.com/Scion-Framework/File)
* [scion/http](https://github.com/Scion-Framework/Http)
* [scion/stdlib](https://github.com/Scion-Framework/Stdlib)
* [scion/utils](https://github.com/Scion-Framework/Utils)

## Quick Start
```php
// Create a client object
$client = new \Scion\Github\Client();

// Miscellaneous
$miscellaneous = $client->getReceiver(\Scion\GitHub\Client::MISCELLANEOUS);

// Lists all the emojis available to use on GitHub.
$emojis = $miscellaneous->getReceiver(\Scion\GitHub\Receiver\Miscellaneous::EMOJIS);
$emojis->get();
```

## Documentation
The full documentation is available in the [wiki section](https://github.com/Scion-Framework/GitHubAPI/wiki).

## License
The files in this archive are released under the [GNU Lesser GPL v3](https://github.com/Scion-Framework/scion-core/blob/develop/LICENSE) license.
