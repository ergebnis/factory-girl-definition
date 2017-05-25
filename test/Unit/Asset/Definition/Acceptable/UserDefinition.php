<?php

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Unit\Asset\Definition\Acceptable;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definition;

/**
 * Is acceptable as it implements the ProviderInterface.
 */
final class UserDefinition implements Definition
{
    public function accept(FixtureFactory $factory)
    {
        $factory->defineEntity('Foo');
    }
}
