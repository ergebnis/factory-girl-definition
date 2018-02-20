# factory-girl-definition

[![Build Status](https://travis-ci.org/localheinz/factory-girl-definition.svg?branch=master)](https://travis-ci.org/localheinz/factory-girl-definition)
[![codecov](https://codecov.io/gh/localheinz/factory-girl-definition/branch/master/graph/badge.svg)](https://codecov.io/gh/localheinz/factory-girl-definition)
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

Implement one of the

* `Localheinz\FactoryGirl\Definition\Definition` 
* `Localheinz\FactoryGirl\Definition\FakerAwareDefinition` 

interfaces and use the instance of `FactoryGirl\Provider\Doctrine\FixtureFactory` 
that is passed into `accept()` to define entities:

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
and use `Definitions` to find definitions, register definitions with the 
fixture factory, and optionally provide definitions with an instance of 
`Faker\Generator`:
 
```php
<?php

namespace Foo\Bar\Test\Integration;

use Doctrine\ORM;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Faker\Generator;
use Localheinz\FactoryGirl\Definition\Definitions;
use PHPUnit\Framework;

abstract class AbstractIntegrationTestCase extends Framework\TestCase
{
    /**
     * @var FixtureFactory
     */ 
    private $fixtureFactory;
    
    final protected function entityManager(): ORM\EntityManager
    {
        // ...
    }
    
    final protected function faker(): Generator
    {
        // ...
    }
    
    final protected function fixtureFactory(): FixtureFactory
    {
        if (null === $this->fixtureFactory) {
            $fixtureFactory = new FixtureFactory($this->entityManager());
            $fixtureFactory->persistOnGet(true);
            
            Definitions::in(__DIR__ . '/../Fixture')
                ->registerWith($fixtureFactory)
                ->provideWith($this->faker());
            
            $this->fixtureFactory = $fixtureFactory;
        }
        
        return $this->fixtureFactory;
    }
}
```

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## Code of Conduct

Please have a look at [`CODE_OF_CONDUCT.md`](.github/CODE_OF_CONDUCT.md).

## License

This package is licensed using the MIT License.
