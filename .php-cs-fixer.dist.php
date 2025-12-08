<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

return (new Config())
    ->setParallelConfig(ParallelConfigFactory::detect()) // @TODO 4.0 no need to call this manually
    ->setRiskyAllowed(false)
    ->setRules([
        '@auto' => true,
        '@PhpCsFixer' => true,

        'simplified_null_return' => false,
        'control_structure_braces' => false,
        'new_with_parentheses' => [
            'anonymous_class' => true,
            'named_class' => true,
        ],
        'single_import_per_statement' => false,
        'not_operator_with_successor_space' => false,
        'group_import' => true,
        'no_useless_concat_operator' => true,
        'no_unset_cast' => true,
        'single_quote' => true,
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => [
                '|' => 'no_space',
            ],
        ],
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'none',
                'method' => 'one',
                'property' => 'none',
                'trait_import' => 'none',
                'case' => 'none',
            ],
        ],
        'no_extra_blank_lines' => [
            'tokens' => [
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'return',
                'square_brace_block',
                'throw',
                'switch',
                'case',
                'default',
                'continue',
            ],
        ],
        'phpdoc_separation' => [
            'groups' => [['*']],
        ],
    ])
    // 💡 by default, Fixer looks for `*.php` files excluding `./vendor/` - here, you can groom this config
    ->setFinder(
        (new Finder())
            // 💡 root folder to check
            ->in(__DIR__.'/src')
            // 💡 additional files, eg bin entry file
            // ->append([__DIR__.'/bin-entry-file'])
            // 💡 folders to exclude, if any
            // ->exclude([/* ... */])
            // 💡 path patterns to exclude, if any
            // ->notPath([/* ... */])
            // 💡 extra configs
            // ->ignoreDotFiles(false) // true by default in v3, false in v4 or future mode
            // ->ignoreVCSIgnored(true) // true by default
    )
;
