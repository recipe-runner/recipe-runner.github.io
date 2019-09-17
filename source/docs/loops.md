---
title: Loops
description: Loops in steps and actions
extends: _layouts.documentation
section: content
---

# Loops

Sometimes you want to repeat a [block](recipes/#blocks) multiple times and loops
can help you.

```yaml
actions:
  - write: "Inside a loop"
    loop: 1..3
```

In the above example, the expression `1..3` is equivalent to `[1,2,3]`. The `write` method will
be invoked three times. 

```yaml
actions:
  - write: "Inside a loop"
    loop: [1,2,3]
```

Previous example is using a Javascript-liked syntax. You can use Yaml syntax to create a list
of elements:

```yaml
actions:
  - write: "Inside a loop"
    loop:
      - 1
      - 2
      - 3 
```

A mapping list:

```yaml
actions:
  - write: "Inside a loop"
    loop:
      # The number of spaces between the colon and the value does not matter
      one:   1
      two:   2
      three: 3
```

Another way of writing a mapping list:

```yaml
actions:
  - write: "Inside a loop"
    loop: { one: 1, two: 2, three: 3 }
```

## Accessing loop data

Information about the current loop is available at `loop` variable:

* **index** (`string`|`int`) Contains the value acting as index.
* **value** Value associated to the index.

```yaml
  actions:
    - write: "Inside the loop: Key: {{loop['index']}} Value: {{loop['value']}}"
      loop: { one: 1, two: 2, three: 3 }
    - write: "(alternative) Inside the loop: Key: {{loop.get('index')}} Value: {{loop.get('value')}}"
      loop: { one: 1, two: 2, three: 3 }
```

In case of step loops, the same information is available at `step_loop`:

```yaml
steps:
  - actions:
      - write: 
          - "Inside the loop: Key: {{loop['index']}} Value: {{loop['value']}}"
          - "Step loop: Key: {{step_loop['index']}} Value: {{step_loop['value']}}"
        loop: { one: 1, two: 2, three: 3 }
    loop: { one: 1, two: 2, three: 3 }
```

## Loops and conditionals

Bear in mind that the `when` (see [conditionals](/docs/conditionals)) statement is processed
separately for each item in the loop. That means a block will be executed only if `when`
expression is true. Otherwise, the iteration will be marked as `skipped`.

```yaml
steps:
  - name: The loop
    actions:
      - name: Display data
        write: 
          - "Inside the loop: Key: {{loop['index']}} Value: {{loop['value']}}"
        loop: { one: 1, two: 2, three: 3 }
        when: loop['value'] == 2
    loop: { one: 1, two: 2, three: 3 }
    when: step_loop['index'] == 'one'
```

In the previous example, the step "The loop" has a loop with three elements but the action
"Display data" only be executed one time when the value of the *index* is "one"

## Registering variables with a loop

When you use `register` with a loop, the data structure placed in the variable registered will
contain a list of all responses from the module:

```yml
steps:
  - actions:
      - ask: Type a number
        loop: 1..2
        register: number
      - write: 
          - "The first number was {{registered['number'][0]['response']}}"
          - "The second number was {{registered['number'][1]['response']}}"
```
