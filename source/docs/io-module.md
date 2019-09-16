---
title: IO module
description: Method exposes by IO module
extends: _layouts.documentation
section: content
---

# IO Module

This module let you interact with the user with method to ask something or display a text.

## Installation

Create a recipe and add the module to the `packages` section:

```yaml
name: "Your recipe"
extra:
  rr:
    packages:
      "recipe-runner/io-module": "1.0.x-dev"
```
## Methods

* [write](#write)
* [ask](#ask)
* [ask_yes_no](#ask_yes_no)

### write {#write}

Write a message to the output.

**Parameters**

(`string`|`array of strings`) Text that will be displayed.

**Return values**

None

**Examples:**

```yaml
actions:
  - write: "Hi user. Welcome back."
```

Messages with several lines are allowed:

```yaml
actions:
  - write: 
      - "Hi user"
      - "Welcome :)"
```

### ask {#ask}

Ask a question to the user.

**Parameters**

* **question** (`string`) The question.
* **default** (`number`|`string`|`null`) The default value in case the user does not response the question. Empty string by default.

**Return values**

* **response** (`string`) The response of the user.

**Examples:**
```yaml
actions:
  - ask: "What's your name?"
      register: "question"
  - write: "The Response was: '{{registered['question']['response']}}'"
```

Setting a default value:

```yaml
actions:
  - ask:
      question: "What's your name?"
      default: "Jack"
```

### ask_yes_no {#ask_yes_no}

Ask a yes/no question to the user.

Values accepted as response:

* `true`: true, "true", "yes", "1", 1
* `false`: false, "false", "no", "0", 0

**Parameters**

* **question** (`string`) The yes/no question.
* **default** (`bool`) The default value in case the user does not response the question. `true` by default.

**Return values**

* **response** (`bool`) The response of the user.

**Examples:**

```yaml
actions:
  - ask_yes_no: "Are you sure?"
```

Setting a default value:

```yaml
actions:
  - ask_yes_no:
      question: "What's your name?"
      default: true
```
