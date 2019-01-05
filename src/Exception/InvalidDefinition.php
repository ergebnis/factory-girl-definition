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

namespace Localheinz\FactoryGirl\Definition\Exception;

final class InvalidDefinition extends \RuntimeException
{
    public static function fromClassNameAndException(string $className, \Exception $exception): self
    {
        return new self(
            \sprintf(
                'An exception was thrown while trying to instantiate definition "%s".',
                $className
            ),
            0,
            $exception
        );
    }
}
