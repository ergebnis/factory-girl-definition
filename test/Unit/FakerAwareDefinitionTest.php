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

use Ergebnis\Test\Util\Helper;
use Localheinz\FactoryGirl\Definition\Definition;
use Localheinz\FactoryGirl\Definition\FakerAwareDefinition;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @coversNothing
 */
final class FakerAwareDefinitionTest extends Framework\TestCase
{
    use Helper;

    public function testExtendsDefinitionInterface(): void
    {
        self::assertInterfaceExtends(Definition::class, FakerAwareDefinition::class);
    }
}
