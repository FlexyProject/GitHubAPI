## 1.1.3 (2017-05-05)
`Added`
* Add missing directive `working_dir` in `docker-composer.yml` file.
* Add new class `\FlexyProject\GitHub\Pagination`.
* Add PHPUnit tests for `\FlexyProject\GitHub\Pagination` class.

## 1.1.2 (2017-03-02)
`Added`
* Add PHPUnit tests.
* Add new method `getRepositoryLicenseContent` in `GitHub/Receiver/Repositories.php` file.
* Add `Api` trait to not have redundant `getApi` and `setApi` methods in all abstract classes.
* Add TravisCI config file.
* Add Scrutinizer badges.
* Add docker container to run unit testing with PHPFarm.
* Add *stable*, *downloads* and *license* badges.

`Changed`
* Update user agent from `scion.github-api` to `FlexyProject-GitHubAPI`.

`Fixed`
* Fix Scrutinizer badge URL.
* Fix `GitHub/Receiver/Miscellaneous/Markdown::renderRaw` method.
* Fixing bug in **Gists** class, `$id` attributes are *string* type, not *integer*. 
* Fixing `Receiver/Repositories/Commits::listCommits` method, closing PR #44.

`Removed`
* Remove useless `use` call in `GitHub\Receiver\Miscellaneous\Licenses` class.
* Removing useless requirement `Zend\Crypt`, using `hash_hmac` instead, issue #42.

## 1.1.1 (2016-08-20)
`Fixed`
* Fix requirement version of `flexyproject/curl` to `1.1.3`.
* Fixing issue #35 with CURL default options.

## 1.1.0 (2016-03-15)
`Added`
* Add missing `.gitignore` file.

`Changed`
* Update namespace from `Scion` to `FlexyProject`.

`Fixed`
* Fix bug, **$since** parameter cannot be `null` or `empty` if used with `DateTime()` class.
* Fixing issue #33, `Issues::listOrganizationIssues` doesn't work.
* Fixing issue #31, Date formatting issue.

`Removed`
* Remove support for PHP**5.x**.

## 1.0.4 (2016-03-15)
`Changed`
* Move sources from `emulienfou` to `Scion`.

## dev (2015-01-08)
* Require PHP >= **5.6.1**.
