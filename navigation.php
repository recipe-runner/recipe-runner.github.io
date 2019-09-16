<?php
/**
 * Example of URL with children:
 * 
 * 'Getting Started' => [
 *       'url' => 'docs/getting-started',
 *       'children' => [
 *           'Run a recipe' => 'docs/getting-started#run-a-recipe',
 *       ],
 *   ],
 */
return [
    'Getting Started' => 'docs/getting-started',
    'Recipes' => [
        'url' => 'docs/recipes',
        'children' => [
            'Steps' => 'docs/steps',
            'Actions' => 'docs/actions',
            'Conditionals' => 'docs/conditionals',
            'Loops' => 'docs/loops',
            'Variables' => 'docs/variables',
            'Recipe syntax' => 'docs/recipe-syntax',
        ],
    ],
    'Expressions' => [
        'url' => 'docs/expressions',
        'children' => [
            'Functions' => 'docs/functions',
        ],
    ],
    'Modules' => [
        'url' => 'docs/modules',
        'children' => [
            'IO module' => 'docs/io-module',
            'System module' => 'docs/system-module',
        ],
    ],
    'Developers' => [
        'url' => 'docs/developers',
        'children' => [
            'Creating new modules' => 'docs/creating-new-modules',
            'Embedding Recipe Runner core' => 'docs/embedding-recipe-runner-core',
        ],
    ],
];
