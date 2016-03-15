# Scion: Wrapper for GitHub API v3
This is a simple Object Oriented wrapper for [GitHub API v3](http://developer.github.com/v3/), written with PHP5.  
This library works with cURL and provides all documented functionality as described in the official documentation including [Client](https://developer.github.com/v3/) and [WebHooks](https://developer.github.com/webhooks/).  
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/)
[![Build Status](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/badges/build.png?b=master)](https://scrutinizer-ci.com/g/Scion-Framework/GitHubAPI/build-status/master)

## Requirements
* PHP >= 5.6.1
* [cURL](http://php.net/manual/en/book.curl.php) extension
* [scion/designpatterns](https://github.com/Scion-Framework/DesignPatterns)
* [scion/crypt](https://github.com/Scion-Framework/Crypt)
* [scion/file](https://github.com/Scion-Framework/File)
* [scion/http](https://github.com/Scion-Framework/Http)
* [scion/stdlib](https://github.com/Scion-Framework/Stdlib)
* [scion/utils](https://github.com/Scion-Framework/Utils)
* [scion/validator](https://github.com/Scion-Framework/Validator)

## Quick Start
```php
// Create a client object
$client = new \FlexyProject\GitHub\Client();

// Miscellaneous
$miscellaneous = $client->getReceiver(\FlexyProject\GitHub\Client::MISCELLANEOUS);

// Lists all the emojis available to use on GitHub.
$emojis = $miscellaneous->getReceiver(\FlexyProject\GitHub\Receiver\Miscellaneous::EMOJIS);
$emojis->get();
```

## Documentation
The full documentation is available in the [wiki section](https://github.com/Scion-Framework/GitHubAPI/wiki).

## License
The files in this archive are released under the [GNU Lesser GPL v3](LICENSE.md) license.
