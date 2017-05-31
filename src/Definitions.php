<?php

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Zend\File;

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
     * @param string $directory
     *
     * @throws Exception\InvalidDirectory
     * @throws Exception\InvalidDefinition
     *
     * @return self
     */
    public static function in($directory)
    {
        if (!\is_string($directory)) {
            throw Exception\InvalidDirectory::notString($directory);
        }

        if (!\is_dir($directory)) {
            throw Exception\InvalidDirectory::notDirectory($directory);
        }

        $locator = new File\ClassFileLocator($directory);

        /** @var File\PhpClassFile[] $files */
        $files = \iterator_to_array($locator);

        $instance = new self();

        foreach ($files as $file) {
            foreach ($file->getClasses() as $className) {
                try {
                    $reflection = new \ReflectionClass($className);
                } catch (\ReflectionException $exception) {
                    continue;
                }

                if (!$reflection->isSubclassOf(Definition::class) || !$reflection->isInstantiable()) {
                    continue;
                }

                try {
                    $definition = $reflection->newInstance();
                } catch (\Exception $exception) {
                    throw Exception\InvalidDefinition::fromClassNameAndException(
                        $className,
                        $exception
                    );
                }

                $instance->definitions[] = $definition;
            }
        }

        return $instance;
    }

    public function registerWith(FixtureFactory $fixtureFactory)
    {
        foreach ($this->definitions as $definition) {
            $definition->accept($fixtureFactory);
        }
    }
}
