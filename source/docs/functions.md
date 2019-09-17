---
title: Expression Functions
description: Expression Functions
extends: _layouts.documentation
section: content
---

# Expression Functions

> More functions will be added. keep in mind Recipe Runner is in a very early stage.

## env {#env}

Returns the value of an environment variable.

```yaml
actions:
    - register_variables:
        db_password: "{{env('db_password')}}"
    register: my_variables
```

**Parameters**

* **name** (`string`) The variable name

**Return value**

(`string`|`null`) Returns the value of the environment variable `name`, or `null` if 
variable `name` does not exist.

## version_compare {#version_compare}

Compares two version strings following the pattern `mayor.minor.patch`.
This function may be used for executing actions only if the version of PHP meets the constraint.

```yaml
when: "version_compare(php_version, '>', '7.0.0')"
```

**Parameters**

* **version1** (`string`)
* **operator** (`string`) Operator. Valid values: `<`, `<=`, `>`, `>=`, `=`, `!=`.
* **version2** (`string`)

**Return value**

(`bool`) True if the relationship is the one specified by the operator, false otherwise.
