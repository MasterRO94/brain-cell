<?php

return PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRules(
        [
            '@Symfony' => true,

            'concat_space' => ['spacing' => 'one'],
            'array_syntax' => ['syntax' => 'short'],

            'class_definition' => [
                'singleLine' => false,
                'singleItemSingleLine' => false,
                'multiLineExtendsEachSingleLine' => false,
            ],

            'no_multiline_whitespace_before_semicolons' => true,
            'no_extra_consecutive_blank_lines' => false,
            'phpdoc_inline_tag' => true,
            'phpdoc_align' => false,
            'phpdoc_indent' => false,
            'phpdoc_annotation_without_dot' => false,
            'phpdoc_var_without_name' => false,
        ]
    )
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in('src')
            ->name('*.php')
    );
