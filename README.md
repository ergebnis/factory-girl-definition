# factory-girl-definition

[![Build Status](https://travis-ci.org/localheinz/factory-girl-definition.svg?branch=master)](https://travis-ci.org/localheinz/factory-girl-definition)
[![Code Climate](https://codeclimate.com/github/localheinz/factory-girl-definition/badges/gpa.svg)](https://codeclimate.com/github/localheinz/factory-girl-definition)
[![Test Coverage](https://codeclimate.com/github/localheinz/factory-girl-definition/badges/coverage.svg)](https://codeclimate.com/github/localheinz/factory-girl-definition/coverage)
[![Issue Count](https://codeclimate.com/github/localheinz/factory-girl-definition/badges/issue_count.svg)](https://codeclimate.com/github/localheinz/factory-girl-definition)
[![Latest Stable Version](https://poser.pugx.org/localheinz/factory-girl-definition/v/stable)](https://packagist.org/packages/localheinz/factory-girl-definition)
[![Total Downloads](https://poser.pugx.org/localheinz/factory-girl-definition/downloads)](https://packagist.org/packages/localheinz/factory-girl-definition)

Provides an interface for, and an easy way to find and register entity definitions for [`breerly/factory-girl-php`](https://github.com/breerly/factory-girl-php).

## Installation

Run

```
$ composer require --dev localheinz/factory-girl-definition
```

## Usage

### Create Definitions

Implement the `Definition` interface and use the instance of `FactoryGirl\Provider\Doctrine\FixtureFactory` 
that is passed in into `accept()` to define entities:

```php
<?php

namespace Foo\Bar\Test\Fixture\Entity;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Foo\Bar\Entity;
use Localheinz\FactoryGirl\Definition\Definition;

final class UserDefinition implements Definition
{
    public function accept(FixtureFactory $fixtureFactory)
    {
        $fixtureFactory->defineEntity(Entity\User::class, [
            // ...
        ]);
    }
}
```

:bulb: Any number of entities can be defined within a definition.
However, it's probably a good idea to create a definition for each entity. 
 
### Register Definitions

Lazily instantiate an instance of `FactoryGirl\Provider\Doctrine\FixtureFactory` 
and use `Definitions` to find definitions and register them with the factory:
 
```php
<?php

namespace Foo\Bar\Test\Integration;

use Doctrine\ORM;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definitions;
use PHPUnit\Framework;

abstract class AbstractIntegrationTestCase extends Framework\TestCase
{
    /**
     * @return ORM\EntityManager
     */
    final protected function entityManager()
    {
        // ...
    }
    
    /**
     * @return FixtureFactory
     */
    final protected function fixtureFactory()
    {
        static $fixtureFactory = null;
        
        if (null === $fixtureFactory) {
            $fixtureFactory = new Doctrine\FixtureFactory($entityManager);
            $fixtureFactory->persistOnGet(true);
            
            Definitions::in(__DIR__ . '/../Fixture')->registerWith($fixtureFactory);
        }
        
        return $fixtureFactory;
    }
}
```

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## Code of Conduct

Please have a look at [`CODE_OF_CONDUCT.md`](.github/CODE_OF_CONDUCT.md).

## License

This package is licensed using the MIT License.
