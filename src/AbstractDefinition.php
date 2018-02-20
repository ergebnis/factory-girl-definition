<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition;

use Faker\Generator;

abstract class AbstractDefinition implements FakerAwareDefinition
{
    /**
     * @var Generator
     */
    private $faker;

    final public function provideWith(Generator $faker)
    {
        $this->faker = $faker;
    }

    /**
     * @throws \BadMethodCallException
     *
     * @return Generator
     */
    final public function faker(): Generator
    {
        if (null === $this->faker) {
            throw new \BadMethodCallException(\sprintf(
                'Before accessing, an instance of "%s" needs to be provided using provideWith()',
                Generator::class
            ));
        }

        return $this->faker;
    }
}
