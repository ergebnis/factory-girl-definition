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

use Ergebnis\PhpCsFixer\Config;

$header = <<<'EOF'
Copyright (c) 2017 Andreas Möller

For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.

@link https://github.com/ergebnis/factory-girl-definition
EOF;

$config = Config\Factory::fromRuleSet(new Config\RuleSet\Php71($header));

$config->getFinder()
    ->ignoreDotFiles(false)
    ->in(__DIR__)
    ->exclude([
        '.build',
        '.dependabot',
        '.github',
        'test/Fixture/Definition/CanNotBeAutoloaded',
    ])
    ->name('.php_cs');

$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php_cs.cache');

return $config;
