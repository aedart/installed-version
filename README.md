# Installed Version

[![Latest Stable Version](https://poser.pugx.org/aedart/dto/v/stable)](https://packagist.org/packages/aedart/dto)
[![Total Downloads](https://poser.pugx.org/aedart/dto/downloads)](https://packagist.org/packages/aedart/dto)
[![Latest Unstable Version](https://poser.pugx.org/aedart/dto/v/unstable)](https://packagist.org/packages/aedart/dto)
[![License](https://poser.pugx.org/aedart/dto/license)](https://packagist.org/packages/aedart/dto)

Utility that attempts to identify what version of a given package you have installed

## Contents

* [How to install](#how-to-install)
* [Quick start](#quick-start)
* [Future versions](#future-versions)
* [Contribution](#contribution)
* [Acknowledgement](#acknowledgement)
* [Versioning](#versioning)
* [License](#license)

## How to install

```console
composer require aedart/installed-version
```

This package uses [composer](https://getcomposer.org/). If you do not know what that is or how it works, I recommend that you read a little about, before attempting to use this package.

## Quick start

```php

use Aedart\Installed\Version\Reader;

$reader = new Reader();

echo $reader->getVersion('amce/rocket-computer');

// Example output 1.22.4 ... 1.0.x-dev, or Unknown cannot find / read package
```

The default `Reader` component attempts to fetch the version from composer's `installed.json` file, which should be found inside your local or global vendor.
 
If the reader does not find the desired package there, it will look for the `composer.json` file in the current workign directory. If it matches the desired package, it attempts reading the version from it (or it's [branch-alias](https://getcomposer.org/doc/articles/aliases.md)).

Lastly, if nothing was found `Unknown` is returned.

**Tip**: You should cache the version because "guessing" the version does come at some cost. Reading files, decoding them, looping through them...etc.

## Future versions

In a future version of this package, I will attempt to improve performance as well as the correctness of how to obtain the correct version number of a installed package.
 
If you know how to, please feel free to submit one or two pull requests.

## Contribution

Have you found a defect ( [bug or design flaw](https://en.wikipedia.org/wiki/Software_bug) ), or do you wish improvements? In the following sections, you might find some useful information
on how you can help this project. In any case, I thank you for taking the time to help me improve this project's deliverables and overall quality.

### Bug Report

If you are convinced that you have found a bug, then at the very least you should create a new issue. In that given issue, you should as a minimum describe the following;

* Where is the defect located
* A good, short and precise description of the defect (Why is it a defect)
* How to replicate the defect
* (_A possible solution for how to resolve the defect_)

When time permits it, I will review your issue and take action upon it.

### Fork, code and send pull-request

A good and well written bug report can help me a lot. Nevertheless, if you can or wish to resolve the defect by yourself, here is how you can do so;

* Fork this project
* Create a new local development branch for the given defect-fix
* Write your code / changes
* Create executable test-cases (prove that your changes are solid!)
* Commit and push your changes to your fork-repository
* Send a pull-request with your changes
* _Drink a [Beer](https://en.wikipedia.org/wiki/Beer) - you earned it_ :)

As soon as I receive the pull-request (_and have time for it_), I will review your changes and merge them into this project. If not, I will inform you why I choose not to.

## Acknowledgement

* [Nils Adermann & Jordi Boggiano](https://getcomposer.org/), best thing that happened for the PHP community

## Versioning

This package follows [Semantic Versioning 2.0.0](http://semver.org/)

## License

[BSD-3-Clause](http://spdx.org/licenses/BSD-3-Clause), Read the LICENSE file included in this package