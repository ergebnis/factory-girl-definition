<?php

/**
 * Copyright (c) 2017 Andreas Möller
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
use PHPUnit\Framework;
use Refinery29\Test\Util;

final class DefinitionsTest extends Framework\TestCase
{
    use Util\TestHelper;

    /**
     * @dataProvider \Refinery29\Test\Util\DataProvider\InvalidString::data()
     *
     * @param mixed $directory
     */
    public function testInRejectsInvalidString($directory)
    {
        $this->expectException(Exception\InvalidDirectory::class);

        Definitions::in($directory);
    }

    public function testInRejectsNonExistentDirectory()
    {
        $this->expectException(Exception\InvalidDirectory::class);

        Definitions::in(__DIR__ . '/Asset/Definition/NonExistentDirectory');
    }

    public function testInIgnoresClassesWhichCanNotBeAutoloaded()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->never())
            ->method($this->anything());

        Definitions::in(__DIR__ . '/Asset/Definition/CanNotBeAutoloaded')->registerWith($fixtureFactory);
    }

    public function testInIgnoresClassesWhichDoNotImplementProviderInterface()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->never())
            ->method($this->anything());

        Definitions::in(__DIR__ . '/Asset/Definition/DoesNotImplementInterface')->registerWith($fixtureFactory);
    }

    public function testInIgnoresClassesWhichAreAbstract()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->never())
            ->method($this->anything());

        Definitions::in(__DIR__ . '/Asset/Definition/IsAbstract')->registerWith($fixtureFactory);
    }

    public function testInIgnoresClassesWhichHavePrivateConstructors()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->never())
            ->method($this->anything());

        Definitions::in(__DIR__ . '/Asset/Definition/PrivateConstructor')->registerWith($fixtureFactory);
    }

    public function testInAcceptsClassesWhichAreAcceptable()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->once())
            ->method('defineEntity');

        Definitions::in(__DIR__ . '/Asset/Definition/Acceptable')->registerWith($fixtureFactory);
    }

    public function testThrowsInvalidDefinitionExceptionIfInstantiatingDefinitionsThrowsException()
    {
        $fixtureFactory = $this->createFixtureFactoryMock();

        $fixtureFactory
            ->expects($this->never())
            ->method($this->anything());

        $this->expectException(Exception\InvalidDefinition::class);

        Definitions::in(__DIR__ . '/Asset/Definition/ThrowsExceptionDuringConstruction');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FixtureFactory
     */
    private function createFixtureFactoryMock()
    {
        return $this->createMock(FixtureFactory::class);
    }
}
