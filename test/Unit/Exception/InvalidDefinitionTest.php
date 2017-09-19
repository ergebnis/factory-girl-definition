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

namespace Localheinz\FactoryGirl\Definition\Test\Unit\Exception;

use Localheinz\FactoryGirl\Definition\Exception;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

final class InvalidDefinitionTest extends Framework\TestCase
{
    use Helper;

    public function testExtendsRuntimeException()
    {
        $this->assertClassExtends(\RuntimeException::class, Exception\InvalidDefinition::class);
    }

    public function testFromClassNameCreatesException()
    {
        $className = $this->faker()->word;
        $previousException = new \Exception();

        $exception = Exception\InvalidDefinition::fromClassNameAndException(
            $className,
            $previousException
        );

        $this->assertInstanceOf(Exception\InvalidDefinition::class, $exception);

        $message = \sprintf(
            'An exception was thrown while trying to instantiate definition "%s".',
            $className
        );

        $this->assertSame($message, $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
        $this->assertSame($previousException, $exception->getPrevious());
    }
}
