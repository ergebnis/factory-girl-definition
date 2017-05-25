<?php

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
    /**
     * @param string     $className
     * @param \Exception $exception
     *
     * @return self
     */
    public static function fromClassNameAndException($className, \Exception $exception)
    {
        return new self(
            \sprintf(
                'An exception was thrown while trying to instantiate definition "%s".',
                $className
            ),
            null,
            $exception
        );
    }
}
