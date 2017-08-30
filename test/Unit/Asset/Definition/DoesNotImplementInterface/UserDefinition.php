<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Unit\Asset\Definition\DoesNotImplementInterface;

use FactoryGirl\Provider\Doctrine\FixtureFactory;

/**
 * Is not acceptable as it does not implement the DefinitionInterface.
 */
final class UserDefinition
{
    public function accept(FixtureFactory $factory)
    {
        $factory->defineEntity('Foo');
    }
}
