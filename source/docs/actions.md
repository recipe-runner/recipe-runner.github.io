---
title: Actions
description: Actions of a step
extends: _layouts.documentation
section: content
---

# Actions

Each step contains a list of task. Task are executed in order one at a time.
**The goal of each task is to execute a method of a module**, with very specific arguments. 
Variables and functions can be used in arguments to modules.

```yaml
steps:
  - name: "OS Info"
    actions:
      - name: "OS family"
        # Method: "write" from recipe-runner/io-module
        write: "Your OS family is {{os_family}}"
```

You can include variables and functions in argument using `{{...}}`. For example, if a value from
an environment variable needs to be displayed, the function `env` can retrieve that value:

```yaml
steps:
  - name: "OS Info"
    actions:
      - name: "Shell"
        write: "Shell path: {{env('SHELL')}}" # Value of the variable "SHELL"
```

Every action should have a name, which is included in the output from running the recipe.
This is human readable output, and so it is useful to provide good descriptions of each action.
If the name is not provided though, a name will be generated automatically following
the pattern `Task: {{number}}`.

## Registering the result of a module execution {#registering_execution}

Sometimes, it is useful to execute a task and save the return value in a variable for use
in later tasks. In that case, a new variable could be registered with result. See 
[Registering variables](variables/#registering-result-task).

## Module methods

Module methods consists of a method name and it might has arguments.

```yaml
actions:
  - name: Shell
    run:
      command: echo fool
      cwd: "/tmp"
```

In the previous example, `run` is the method and `command` and `cwd` are arguments.

### Assigning values to arguments

Arguments allow the types accepted by YAML. Additionally you can use expressions for resolving the value of an arguments:

```yaml
actions:
  - name: Shell
    run:
      command: "echo {{1+1}}"     # String interpolation is allowed.
      cwd: "{{env('USER_DIR')}}"  # "pure" expression begins and ends with 
                                  # double curly braces
      timeout: 10
```
String interpolations are allowed and all the expressions inside them will be resolved before executing the method.
The expression `echo {{1+1}}` will be a string like this `echo 2`.

**Pure expressions**: as expressions are strings there would be no way to assign a different value from a string to an argument.
Pure expression let you assign the result of a resolved expression to an argument without any casting. 
This kind of expression must begin and end with curly braces without any space before and after: `{{[1,2,3]}}`.

```yaml
actions:
  - register_variables:
      list: "{{[1,2,3]}}"
      register: my_vars
```

The previous example registers a variable called `list` whose value is an array with three elements.