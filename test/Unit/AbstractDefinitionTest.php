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

namespace Localheinz\FactoryGirl\Definition\Test\Unit;

use Faker\Generator;
use Localheinz\FactoryGirl\Definition\AbstractDefinition;
use Localheinz\FactoryGirl\Definition\FakerAwareDefinition;
use Localheinz\FactoryGirl\Definition\Test\Fixture;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 */
final class AbstractDefinitionTest extends Framework\TestCase
{
    use Helper;

    public function testImplementsFakerAwareDefinitionInterface(): void
    {
        $this->assertClassImplementsInterface(FakerAwareDefinition::class, AbstractDefinition::class);
    }

    public function testFakerThrowsBadMethodCallExceptionIfDefinitionHasNotBeenProvidedWithFaker(): void
    {
        $definition = new Fixture\Definition\ExtendsAbstractDefinition\UserDefinition();

        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage(\sprintf(
            'Before accessing, an instance of "%s" needs to be provided using provideWith()',
            Generator::class
        ));

        $definition->faker();
    }

    public function testFakerReturnsFakerWhenProvidedWithIt(): void
    {
        $faker = new Generator();

        $definition = new Fixture\Definition\ExtendsAbstractDefinition\UserDefinition();

        $definition->provideWith($faker);

        self::assertSame($faker, $definition->faker());
    }
}
