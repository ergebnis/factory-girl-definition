# factory-girl-definition

[![Integrate](https://github.com/ergebnis/factory-girl-definition/workflows/Integrate/badge.svg?branch=main)](https://github.com/ergebnis/factory-girl-definition/actions)
[![Prune](https://github.com/ergebnis/factory-girl-definition/workflows/Prune/badge.svg?branch=main)](https://github.com/ergebnis/factory-girl-definition/actions)
[![Release](https://github.com/ergebnis/factory-girl-definition/workflows/Release/badge.svg?branch=main)](https://github.com/ergebnis/factory-girl-definition/actions)
[![Renew](https://github.com/ergebnis/factory-girl-definition/workflows/Renew/badge.svg?branch=main)](https://github.com/ergebnis/factory-girl-definition/actions)

[![Code Coverage](https://codecov.io/gh/ergebnis/factory-girl-definition/branch/main/graph/badge.svg)](https://codecov.io/gh/ergebnis/factory-girl-definition)
[![Type Coverage](https://shepherd.dev/github/ergebnis/factory-girl-definition/coverage.svg)](https://shepherd.dev/github/ergebnis/factory-girl-definition)

[![Latest Stable Version](https://poser.pugx.org/ergebnis/factory-girl-definition/v/stable)](https://packagist.org/packages/ergebnis/factory-girl-definition)
[![Total Downloads](https://poser.pugx.org/ergebnis/factory-girl-definition/downloads)](https://packagist.org/packages/ergebnis/factory-girl-definition)

Provides an interface for, and an easy way to find and register entity definitions for [`breerly/factory-girl-php`](https://github.com/breerly/factory-girl-php).

## Installation

Run

```
$ composer require --dev ergebnis/factory-girl-definition
```

## Usage

### Create Definitions

Implement one of the

* `Ergebnis\FactoryGirl\Definition\Definition`
* `Ergebnis\FactoryGirl\Definition\FakerAwareDefinition`

interfaces and use the instance of `FactoryGirl\Provider\Doctrine\FixtureFactory`
that is passed into `accept()` to define entities:

```php
<?php

namespace Foo\Bar\Test\Fixture\Entity;

use Ergebnis\FactoryGirl\Definition\Definition;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Foo\Bar\Entity;

final class UserDefinition implements Definition
{
    public function accept(FixtureFactory $fixtureFactory): void
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
use Ergebnis\FactoryGirl\Definition\Definitions;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Faker\Generator;
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

Please have a look at [`CODE_OF_CONDUCT.md`](https://github.com/ergebnis/.github/blob/main/CODE_OF_CONDUCT.md).

This package is licensed using the MIT License.

Please have a look at [`LICENSE.md`](LICENSE.md).
