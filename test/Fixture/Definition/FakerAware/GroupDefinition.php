<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Fixture\Definition\FakerAware;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Faker\Generator;
use Localheinz\FactoryGirl\Definition\FakerAwareDefinition;
use Localheinz\FactoryGirl\Definition\Test\Fixture\Entity;

final class GroupDefinition implements FakerAwareDefinition
{
    /**
     * @var Generator
     */
    private $faker;

    public function accept(FixtureFactory $factory): void
    {
        $factory->defineEntity(Entity\Group::class);
    }

    public function provideWith(Generator $faker): void
    {
        $this->faker = $faker;
    }

    public function faker(): Generator
    {
        return $this->faker;
    }
}
