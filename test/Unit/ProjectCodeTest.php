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

use Localheinz\FactoryGirl\Definition\Test\Fixture;
use Localheinz\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 */
final class ProjectCodeTest extends Framework\TestCase
{
    use Helper;

    public function testProductionClassesAreAbstractOrFinal(): void
    {
        $this->assertClassesAreAbstractOrFinal(__DIR__ . '/../../src');
    }

    public function testProductionClassesHaveTests(): void
    {
        $this->assertClassesHaveTests(
            __DIR__ . '/../../src',
            'Localheinz\\FactoryGirl\\Definition\\',
            'Localheinz\\FactoryGirl\\Definition\\Test\\Unit'
        );
    }

    public function testTestClassesAreAbstractOrFinal(): void
    {
        $this->assertClassesAreAbstractOrFinal(__DIR__ . '/..', [
            Fixture\Definition\CanNotBeAutoloaded\MaybeUserDefinition::class,
        ]);
    }
}
