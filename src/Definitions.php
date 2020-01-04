<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/ergebnis/factory-girl-definition
 */

namespace Ergebnis\FactoryGirl\Definition;

use Ergebnis\Classy;
use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Faker\Generator;

final class Definitions
{
    /**
     * @var Definition[]
     */
    private $definitions = [];

    private function __construct()
    {
    }

    /**
     * Creates a new instance of this class, and collects all definitions found in the specified directory.
     *
     * @param string $directory
     *
     * @throws Exception\InvalidDirectory
     * @throws Exception\InvalidDefinition
     *
     * @return self
     */
    public static function in(string $directory): self
    {
        if (!\is_dir($directory)) {
            throw Exception\InvalidDirectory::notDirectory($directory);
        }

        $instance = new self();

        $constructs = Classy\Constructs::fromDirectory($directory);

        foreach ($constructs as $construct) {
            /** @var class-string $className */
            $className = $construct->name();

            try {
                $reflection = new \ReflectionClass($className);
            } catch (\ReflectionException $exception) {
                continue;
            }

            if (!$reflection->isSubclassOf(Definition::class) || !$reflection->isInstantiable()) {
                continue;
            }

            try {
                /** @var Definition $definition */
                $definition = $reflection->newInstance();
            } catch (\Exception $exception) {
                throw Exception\InvalidDefinition::fromClassNameAndException(
                    $className,
                    $exception
                );
            }

            $instance->definitions[] = $definition;
        }

        return $instance;
    }

    /**
     * Registers all found definitions with the specified fixture factory.
     *
     * @param FixtureFactory $fixtureFactory
     *
     * @return self
     */
    public function registerWith(FixtureFactory $fixtureFactory): self
    {
        foreach ($this->definitions as $definition) {
            $definition->accept($fixtureFactory);
        }

        return $this;
    }

    /**
     * Provides all found definitions with the specified faker generator if they desire it.
     *
     * @param Generator $faker
     *
     * @return self
     */
    public function provideWith(Generator $faker): self
    {
        foreach ($this->definitions as $definition) {
            if ($definition instanceof FakerAwareDefinition) {
                $definition->provideWith($faker);
            }
        }

        return $this;
    }
}
