<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return new Config()
    // ->setParallelConfig(ParallelConfigFactory::detect()) // @TODO 4.0 no need to call this manually
    ->setRiskyAllowed(false)
    ->setRules([
        '@auto' => true,
        '@PhpCsFixer' => true,
        'concat_space' => ['spacing' => 'one'],
        'ordered_types' => ['null_adjustment' => 'always_last'],
        'nullable_type_declaration' => ['syntax' => 'union'],
    ])
    // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
    ->setFinder(
        new Finder()
            ->in(__DIR__.'/src/*')
            ->append([__DIR__.'/public/*'])
            ->exclude([__DIR__.'/public/fonts/*', __DIR__ . '/public/files/*'])
    )
;



