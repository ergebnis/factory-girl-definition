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

namespace Localheinz\FactoryGirl\Definition\Test\Unit;

use FactoryGirl\Provider\Doctrine\FixtureFactory;
use Localheinz\FactoryGirl\Definition\Definitions;
use Localheinz\FactoryGirl\Definition\Exception;
use Localheinz\FactoryGirl\Definition\Test\Fixture;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

final class DefinitionsTest extends Framework\TestCase
{
    use Helper;

    public function testInRejectsNonExistentDirectory()
    {
        $this->expectException(Exception\InvalidDirectory::class);

        Definitions::in(__DIR__ . '/../Fixture/Definition/NonExistentDirectory');
    }

    public function testInIgnoresClassesWhichCanNotBeAutoloaded()
    {
        $fixtureFactory = $this->prophesize(FixtureFactory::class);

        $fixtureFactory
            ->defineEntity()
            ->shouldNotBeCalled();

        Definitions::in(__DIR__ . '/../Fixture/Definition/CanNotBeAutoloaded')->registerWith($fixtureFactory->reveal());
    }

    public function testInIgnoresClassesWhichDoNotImplementProviderInterface()
    {
        $fixtureFactory = $this->prophesize(FixtureFactory::class);

        $fixtureFactory
            ->defineEntity()
            ->shouldNotBeCalled();

        Definitions::in(__DIR__ . '/../Fixture/Definition/DoesNotImplementInterface')->registerWith($fixtureFactory->reveal());
    }

    public function testInIgnoresClassesWhichAreAbstract()
    {
        $fixtureFactory = $this->prophesize(FixtureFactory::class);

        $fixtureFactory
            ->defineEntity()
            ->shouldNotBeCalled();

        Definitions::in(__DIR__ . '/../Fixture/Definition/IsAbstract')->registerWith($fixtureFactory->reveal());
    }

    public function testInIgnoresClassesWhichHavePrivateConstructors()
    {
        $fixtureFactory = $this->prophesize(FixtureFactory::class);

        $fixtureFactory
            ->defineEntity()
            ->shouldNotBeCalled();

        Definitions::in(__DIR__ . '/../Fixture/Definition/PrivateConstructor')->registerWith($fixtureFactory->reveal());
    }

    public function testInAcceptsClassesWhichAreAcceptable()
    {
        $fixtureFactory = $this->prophesize(FixtureFactory::class);

        $fixtureFactory
            ->defineEntity(Fixture\Entity\User::class)
            ->shouldBeCalled();

        Definitions::in(__DIR__ . '/../Fixture/Definition/Acceptable')->registerWith($fixtureFactory->reveal());
    }

    public function testThrowsInvalidDefinitionExceptionIfInstantiatingDefinitionsThrowsException()
    {
        $this->expectException(Exception\InvalidDefinition::class);

        Definitions::in(__DIR__ . '/../Fixture/Definition/ThrowsExceptionDuringConstruction');
    }
}
