<?php

declare(strict_types=1);

/**
 * Copyright (c) 2017 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/ergebnis/factory-girl-definition
 */

namespace Ergebnis\FactoryGirl\Definition\Test\Unit\Exception;

use Ergebnis\FactoryGirl\Definition\Exception;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\FactoryGirl\Definition\Exception\InvalidDirectory
 */
final class InvalidDirectoryTest extends Framework\TestCase
{
    use Helper;

    public function testExtendsInvalidArgumentException(): void
    {
        self::assertClassExtends(\InvalidArgumentException::class, Exception\InvalidDirectory::class);
    }

    public function testNotDirectoryCreatesException(): void
    {
        $directory = self::faker()->word;

        $exception = Exception\InvalidDirectory::notDirectory($directory);

        self::assertInstanceOf(Exception\InvalidDirectory::class, $exception);

        $message = \sprintf(
            'Directory should be a directory, but "%s" is not.',
            $directory
        );

        self::assertSame($message, $exception->getMessage());
    }
}
