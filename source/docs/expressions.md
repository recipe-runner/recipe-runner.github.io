---
title: Expressions
description: Recipe syntax
extends: _layouts.documentation
section: content
---

# Expression syntax

Expression used by Recipe Runner are based on [Symfony ExpressionLanguage component](https://symfony.com/doc/current/components/expression_language/syntax.html).

## Literals

* **strings** - single and double quotes (e.g. 'hello')
* **numbers** - e.g. 103
* **arrays** - using JSON-like notation (e.g. `[1, 2]`)
* **hashes** - using JSON-like notation (e.g. `{ foo: 'bar' }`)
* **booleans** - `true` and `false`
* **null** - `null`

## Calling functions

Recipe Runner has a set of built-in functions that may be used in expressions. See [Functions](/docs/functions).

```yaml
when: foo(1) > 1
```

## Operators

### Arithmetic Operators

* `+` (addition)
* `-` (subtraction)
* `*` (multiplication)
* `/` (division)
* `%` (modulus)
* `**` (pow)

```yaml
actions:
  - foo:
      param1: {{1+1+1}}
```

### Bitwise Operators

* `&` (and)
* `|` (or)
* `^` (xor)

### Comparison Operators

* `==` (equal)
* `===` (identical)
* `!=` (not equal)
* `!==` (not identical)
* `<` (less than)
* `>` (greater than)
* `<=` (less than or equal to)
* `>=` (greater than or equal to)
* `matches` (regex match)

```yaml
when: not ("foo" matches "/bar/")
#or
when: not (registered["foo1"]["foo2"] matches "/bar/")
```

### Logical Operators

* `not` or `!`
* `and` or `&&`
* `or` or `||`

### String Operators

* `~` (concatenation)

### Array Operators

* `in` (contain)
* `not in` (does not contain)

```yaml
when: foo in ['a', 'b']
```

### Numeric Operators

* `..` (range)

```yaml
when: foo in 1..3 # true when foo's value is 1 or 2 or 3.
#or
loop: 1..20 # create a loop of 20 elements.
```

### Ternary Operators

* `foo ? 'yes' : 'no'`
* `foo ?: 'no'` (equal to foo ? foo : 'no')
* `foo ? 'yes'` (equal to foo ? 'yes' : '')