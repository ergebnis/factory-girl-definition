<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition\Test\Unit;

use PHPUnit\Framework;
use Refinery29\Test\Util;

final class ProjectCodeTest extends Framework\TestCase
{
    use Util\TestHelper;

    public function testProductionCodeIsAbstractOrFinal()
    {
        $this->assertClassesAreAbstractOrFinal(__DIR__ . '/../../src');
    }

    public function testTestCodeIsAbstractOrFinal()
    {
        $this->assertClassesAreAbstractOrFinal(__DIR__ . '/..', [
            'Fixture/Definition/CanNotBeAutoloaded',
        ]);
    }
}
