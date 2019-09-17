<?php

return [
    'baseUrl' => '',
    'production' => false,
    'siteName' => 'Recipe Runner',
    'siteDescription' => 'Recipe Runner let you automate tasks and extend PHP applications',

    'phar_file_url' => 'https://github.com/recipe-runner/rr-cli/releases/download/1.0.0-alpha1/rr.phar',

    // Algolia DocSearch credentials
    'docsearchApiKey' => '',
    'docsearchIndexName' => '',

    // navigation menu
    'navigation' => require_once('navigation.php'),

    // helpers
    'isActive' => function ($page, $path) {
        return ends_with(trimPath($page->getPath()), trimPath($path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return starts_with($path, 'http') ? $path : '/' . trimPath($path);
    },
];
