<?php

/**
 * Copyright (c) 2017 Andreas Möller.
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @link https://github.com/localheinz/factory-girl-definition
 */

namespace Localheinz\FactoryGirl\Definition;

use FactoryGirl\Provider\Doctrine\FixtureFactory;

interface Definition
{
    public function accept(FixtureFactory $fixtureFactory);
}
