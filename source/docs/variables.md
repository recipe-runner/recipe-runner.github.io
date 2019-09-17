---
title: Variables
description: Variables in a recipe
extends: _layouts.documentation
section: content
---

# Variables {#variables}

Variables let you store information got from expressions, literal values or a actions.
To understand variables you’ll also want to read [conditionals](conditionals) and [loops](loops).

## Creating valid variable names

Variable names should be letters, numbers, and underscores.
Variables should always start with a letter.

> The use of underscore `_` instead of hyphen `-` is encouraged.

`foo` and `foo_name` are good variable names.

## Registering variables {#registering-variables}

Variables could be registered using the method `register_variables`. This method
is part of the [Recipe Runner Core](https://github.com/recipe-runner/recipe-runner)
and as arguments it expects a dictionary which maps keys (variable names) to values.

```yaml
steps:
  - name: "Creating variables step"
    actions:
      # Two variables will be created: "user_name" and "email"
      - register_variables:
          user_name: "john"
          email: "john@yeah.com"
        register: my_variables
```

> The method "register_variables" let you register variables and they will be available from that moment on.

## Registering the result of an action {#registering-result-action}

Sometimes, it is useful to execute an action and save the return value in a variable for use
in later actions. In that case, register a variable is very useful:

```yaml
steps:
  - name: "Current directory"
    actions:
      - run: pwd
        # Register the result of the command "pwd" in a variable 
        # called "current_dir"
        register: current_dir
        # Display the current directory
      - write: "Current dir: {{registered['current_dir']['output']}}"
```

## Accessing variable data {#accessing-variable-data}

Once you've defined variables, you can use them in actions as argument of methods as well
as part of `loop` and `when` expressions. Also variables are available for steps and
they could be used as part of `loop` and `when` expressions.

When you create a variable, you are registering a variable in the execution context
of the recipe. Registered variables are availables at `registered` key:

```yaml
steps:
  - actions:
      - ask: "How are you? "
        register: "user_response"
      - write: "The Response was: {{registered['user_response']['response']}}"
```

The previous example is using a JSON notation to access the data. The `ask`
method (see [IO Module](io-module/#ask)) stores the value typed by the user inside 
a `response` variable that is part of data stored at the variable registered.

As `registered` is an [dictionary of data](#dictionaries-of-data), variable data can be accessed
using "dot" notation:

```yaml
steps:
  - actions:
      - ask: "How are you? "
        register: "user_response"
      - write: "The Response was: {{registered.get('user_response.response')}}"
```

### Dictionaries of data {#dictionaries-of-data}

Dictionaries are a data structure that exposes the following methods that could be
part of an expression:

#### `get`

Returns the value at the end of the path using *dot* notation. This method admits
a second parameters that set the default value in case the path cannot be resolved:

```php
registered.get('myVariable.success', false)
```

#### `has`

Returns if the given key exists.

```php
registered.has('myVariable')
// or
registered.get('myListVariable').has('name')
```

#### `count`

Counts the number of item in the array.

```php
registered.count()
// or
registered.get('myListVariable').count()
```

## Common variables {#common-variables}

Common variables are a set of read-only variables not created by the recipe that provides information about the environment
in which the recipe is running.

**recipe_dir**

(`string`) Returns the directory in which the recipe file is in.

**current_dir**

(`string`) Returns the current working directory.

**os_family**

(`string`) The operating system family. Possible values: *'Windows', 'BSD', 'Darwin', 'Solaris',
'Linux' or 'Unknown'*.

**dir_separator**

(`string`) Directory separator: `/` or `\`.

**path_separator**

(`string`) Semicolon `;` on Windows, colon `:` otherwise.

**temporal_dir**

(`string`) The path of the temporary directory. E.g: `/tmp` or `C:\Windows\Temp`.

**php_version**

(`string`) The current PHP version following the patter `major.minor.release[extra]`.
