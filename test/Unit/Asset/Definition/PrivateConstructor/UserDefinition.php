<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Unit\Asset\Definition\PrivateConstructor;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definition;

/**
 * Is not acceptable as it has a private constructor.
 */
final class UserDefinition implements Definition
{
    private function __construct()
    {
    }

    public function accept(FixtureFactory $factory)
    {
        $factory->defineEntity('Foo');
    }
}
