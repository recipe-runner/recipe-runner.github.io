---
title: "Developers: Recipe Runner Core in your project"
description: Creating new modules
extends: _layouts.documentation
section: content
---

# Developers: embedding Recipe Runner core

> This is a work-in-progress page. More documetation need to be added.

Embedding Recipe Runner into your project let it the ability to respond to events executing recipes. 
You can think of it like a new way of extending your applications.

## Installation

Recipe Runner is available on Packagist.

To install it, just run:

```bash
$ composer require recipe-runner/recipe-runner
```

## Setup

If you just want to get started and don’t care about tweaking anything, you can use our QuickStart factory to get running with a minimum of fuss.

```php
use RecipeRunner\Definition\RecipeMaker;
use RecipeRunner\RecipeRunner\Recipe\StandardRecipeVariables;
use RecipeRunner\RecipeRunner\Setup\QuickStart;

$recipeVariables = StandardRecipeVariables::getCollectionOfVariables();

// Transform the recipe into a RecipeDefinition
$recipeMaker = new YamlRecipeMaker();
$recipe = $recipeMaker->makeRecipeFromFile('/path-to-a-recipe.yml');

// Create the parser
$recipeParser = QuickStart::Create();

// Execute the recipe
$recipeParser->parse($recipe, $recipeVariables);
```

If you want to pass a collection of modules and an implementation of `IOInterface`, `QuickStart::Create` admits two arguments:
The first one is a collection of modules and the second one is an implementation of the IO interface.