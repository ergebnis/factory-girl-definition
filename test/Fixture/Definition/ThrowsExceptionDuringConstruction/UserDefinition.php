<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Fixture\Definition\ThrowsExceptionDuringConstruction;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definition;

/**
 * Is not acceptable as it throws an exception during construction.
 */
final class UserDefinition implements Definition
{
    public function __construct()
    {
        throw new \RuntimeException();
    }

    public function accept(FixtureFactory $factory)
    {
        $factory->defineEntity(\Localheinz\FactoryGirl\Definition\Test\Fixture\Entity\User::class);
    }
}
