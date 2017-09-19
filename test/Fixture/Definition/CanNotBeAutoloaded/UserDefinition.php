<?php

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Fixture\Definition\CanNotBeAutoloaded;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definition;
use Localheinz\FactoryGirl\Definition\Test\Fixture\Entity;

/**
 * Is not acceptable as it can not be autoloaded (class name does not match file name).
 */
final class MaybeUserDefinition implements Definition
{
    public function accept(FixtureFactory $factory)
    {
        $factory->defineEntity(Entity\User::class);
    }
}
