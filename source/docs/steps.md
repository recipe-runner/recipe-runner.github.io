---
title: Steps
description: Steps of a recipe
extends: _layouts.documentation
section: content
---

# Steps {#steps}

Steps are [blocks](recipes/#blocks) that group one or more actions. That way, a set of actions
could be executed several times or make their execution conditional on a boolean 
[expression](expressions). By composing a step of multiples actions, it's possible to 
build more complex process.

## How are steps executed?

Steps are executed sequentially one at a time. When they have a [condition](conditionals) 
sentence `where`, steps are only executed if the condition expression is evaluated to `true`.
When a step has a `loop` sentence (see [loops](loops)), the loop expression is resolved
and the step is evaluated as much times as elements has the loop. If the `loop` is combined
with a `where` expression, then the conditional expression is processed separately for each
item.

> Combining `when` with `loops`, be aware that the `when` statement is processed separately for each item.

The following recipe has one step called "Say ahoy" with just one action that runs the command `echo`.
That step is executed only if the recipe is being running on Linux:

```yaml
extra:
  rr:
    packages:
      "recipe-runner/system-module": "1.0.x-dev"
steps:
  - name: "Say ahoy"
    actions:
      - run: echo ahoy there
    when: os_family == "Linux"
```

Every step should have a name, which is included in the output from running the recipe.
This is human readable output, so it is useful to provide good descriptions of each step.
If the name is not provided though, a name will be generated automatically following 
the pattern `Step: {{number}}`.