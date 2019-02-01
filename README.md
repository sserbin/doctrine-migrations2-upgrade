[![Build Status](https://travis-ci.com/sserbin/doctrine-migrations2-upgrade.svg?branch=master)](https://travis-ci.com/sserbin/doctrine-migrations2-upgrade)

# Intro
Doctrine migrations 2.0 introduced a number of BC breaks forcing users migrating from 1.x to adjust all of their previous migrations.
This package aims to automate upgrading from 1.x to 2.0 by doing automatic code adjustments for your migration files.

The following bc breaks are covered:
- exception class renames
- main namespace rename
- migration return signature fix (for `up()`, `down()`, `preUp()`, `postUp()`, `preDown()`, `postDown()`, `getDescription()`, `isTransactional()`)

# Installation
```
composer require --dev sserbin/doctrine-migrations2-upgrade:@dev
```
note: can be installed globally as well

# Usage
```
vendor/bin/rector process path/to/migrations --dry-run --autoload-file vendor/autoload.php
```
