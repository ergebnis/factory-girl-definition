<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Exception;

final class InvalidDirectory extends \InvalidArgumentException
{
    /**
     * @param mixed $directory
     *
     * @return self
     */
    public static function notString($directory)
    {
        return new self(\sprintf(
            'Directory should be a string, got %s instead.',
            \is_object($directory) ? \get_class($directory) : \gettype($directory)
        ));
    }

    /**
     * @param string $directory
     *
     * @return self
     */
    public static function notDirectory($directory)
    {
        return new self(\sprintf(
            'Directory should be a directory, but "%s" is not.',
            $directory
        ));
    }
}
