---
title: Recipe syntax
description: Recipe syntax
extends: _layouts.documentation
section: content
---

# Recipe syntax

A recipe is a set of instructions executed sequentially written in a [YAML](https://www.codeproject.com/Articles/1214409/Learn-YAML-in-five-minutes)
file. The recommended extension for recipe files is `.rr.yml`.

## `name`

(`string`) **Optional** The name of your recipe. RR displays the name to help visually identify 
the recipe in execution. If this values is not found the default value will be *Recipe with no name*.

## `extra`
(`array`) **Optional** Extra information about the recipe. RR use this value to describe
which packages will be used by the recipe. Packages a are Composer Packages availables on
[Packagist](https://packagist.org/). Method executed by tasks are defined in modules and
those modules are distributed as Composer packages. The following example show that the
recipe require the [`io-module`](https://packagist.org/packages/recipe-runner/io-module).
The part at the right of the colon indicates the version desired.

```yaml
extra:
  rr:
    packages:
      "recipe-runner/io-module": "1.0.x-dev"
```

## `steps`

(`array of steps`) **Required** Steps of a recipe.

## `step.name`

(`string`) **Optional** The name of the step. If this value is not found, a name will
be assigned automatically following the pattern `Step {{number}}`.

## `step.actions`

(`array of actions`) **Required** Actions of a recipe

## `step.<action>.name`

(`string`) **Optional** The name of the action. If this value is not found, a name will
be assigned automatically following the pattern `Action {{number}}`.

## `step.<action>.<method>`

(`string`) **Required** The name of the method that will be executed by the task.
Each method has it own signature.

## `step.<action>.when`

(`string`) **Optional** Boolean expression. See [conditionals](conditionals). e.g: `foo != 1`

## `step.<action>.loop`

(`array|string`) **Optional** Array or list expression (an expression of which
result is an array). See [loops](loops).

## `step.when`

(`string`) **Optional** Boolean expression. See [conditionals](conditionals). e.g: `foo != 1`

## `step.loop` 

(`array|string`) **Optional** Array or list expression (an expression of which
result is an array). See [loops](loops).
