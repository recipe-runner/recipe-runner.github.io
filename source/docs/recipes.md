---
title: Recipes
description: Know everything about RR recipes
extends: _layouts.documentation
section: content
---

# Recipes {#recipes}

A recipe is a set of instructions executed sequentially written in a [YAML](https://en.wikipedia.org/wiki/YAML) file that let you 
build complex process to automatize tasks or extend your PHP applications. Recipes are made up
of one or more steps which in turn are made up of actions.

## Steps {#steps}

A step is a building [block](#blocks) with a set of actions that will be performed. Steps could be executed several times if they have a `loop` sentence inside (see [loops](loops)).

## Actions {#actions}

Actions are the smallest building [block](#blocks) and each one has a module method that will be invoked
when the action is run. The goal of each action is to execute a module, with very specific arguments.
Variables can be used in arguments to modules. You can create your own modules or use modules shared
through [Packagist](https://packagist.org/).
To use an action in a recipe you must include it in a step. Similar to steps, actions could be
executed several times if they include a sentence `loop`.

## Blocs {#blocks}

Blocs are executable constructions that admit conditionals `when` and could be executed several
times using loops `loop`. **Steps and actions are blocks**.

```yaml
# ...
loop: 1..10
when: php_version == 7.3
```

### Status of a block

When a block is executed, its status is one of the following:

* **Successfull**: When all iterations a block are success
* **Skipped**: When all iterations of a block are skipped
* **Failed**: When at least there is a iteration failed

## Recipe file example {#recipe_file_example}

```yaml
name: "My first recipe"
# Extra information for the recipe
extra:
  rr:
    # Modules are Composer packages
    packages:
      "recipe-runner/io-module": "1.0.x-dev"
steps:
  - actions:
      # The action "Greeting" runs the method "write" from IO module to
      # print a message to the output
      - name: "Greeting"
          write: "Hi user"
          # The action will be executed twice
          loop: 1..2
          # The action only be executed on Linux OS
          when: os_family == "Linux"
```
