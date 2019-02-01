[![Build Status](https://travis-ci.com/sserbin/doctrine-migrations2-upgrade.svg?branch=master)](https://travis-ci.com/sserbin/doctrine-migrations2-upgrade)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sserbin/doctrine-migrations2-upgrade/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sserbin/doctrine-migrations2-upgrade/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/sserbin/doctrine-migrations2-upgrade/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sserbin/doctrine-migrations2-upgrade/?branch=master)

# Intro
Doctrine migrations 2.0 introduced a number of BC breaks forcing users migrating from 1.x to adjust all of their previous migrations.
This package aims to automate upgrading from 1.x to 2.0 by doing automatic code adjustments for your migration files.

The following bc breaks are covered:
- exception class renames
- main namespace rename
- migration classes return type signature fix (for `up()`, `down()`, `preUp()`, `postUp()`, `preDown()`, `postDown()`, `getDescription()`, `isTransactional()`)

# Installation
```
composer require --dev sserbin/doctrine-migrations2-upgrade
# or globally
composer global require sserbin/doctrine-migrations2-upgrade
```

# Usage
```
vendor/bin/rector process path/to/migrations --dry-run --autoload-file vendor/autoload.php
# or if installed globally (assuming global composer is in $PATH)
rector process path/to/migrations --dry-run --autoload-file vendor/autoload.php
```
