<?php

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
use PHPUnit\Framework;
use Refinery29\Test\Util;

final class InvalidDirectoryTest extends Framework\TestCase
{
    use Util\TestHelper;

    public function testExtendsInvalidArgumentException()
    {
        $this->assertExtends(\InvalidArgumentException::class, Exception\InvalidDirectory::class);
    }

    public function testNotDirectoryCreatesException()
    {
        $directory = $this->getFaker()->word;

        $exception = Exception\InvalidDirectory::notDirectory($directory);

        $this->assertInstanceOf(Exception\InvalidDirectory::class, $exception);

        $message = \sprintf(
            'Directory should be a directory, but "%s" is not.',
            $directory
        );

        $this->assertSame($message, $exception->getMessage());
    }
}
