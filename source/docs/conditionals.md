---
title: Conditionals
description: Conditionals in steps and actions
extends: _layouts.documentation
section: content
---

# Conditionals

Often the result of a [block](recipes/#blocks) may depend on the value of a variable or
previous action result. This topic covers how conditionals are used in recipes.

## The when statement

The `when` statement is responsible for receiving conditional expressions, those that return `true` or
`false`, that determine if a block will be executed.

```yaml
actions:
  - run: echo This is Linux
    when: os_family == "Linux"
```

In case of steps:

```yaml
steps:
  - name: 
    actions:
      # Variable "version_required" will be registered only if the recipe
      # is being running on Linux
      - register_variables:
          version_required: "7.3"
        register: "vars"
    where: os_family == "Linux"
```
> You don’t need to use {{ }} to use variables inside conditionals, as these are already implied.

If a required variable has not been set, you can skip a block:

```yaml
actions:
  - write: "Welcome {{registered['var']['foo']}}"
    when: registered.has('var')
```
