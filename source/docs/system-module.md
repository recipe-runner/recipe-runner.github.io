---
title: System module
description: Method exposes by System module
extends: _layouts.documentation
section: content
---

# System module

This module let you execute command and work with files.

## Installation

Create a recipe and add the module to the `packages` section:

```yaml
name: "Your recipe"
extra:
  rr:
    packages:
      "recipe-runner/system-module": "1.0.x-dev"
```

## Methods

* [run](#run)
* [copy_file](#copy_file)
* [download_file](#download_file)
* [make_dir](#make_dir)
* [mirror_dir](#mirror_dir)
* [read_file](#read_file)
* [remove](#remove)
* [write_file](#write_file)

### run {#run}

Executes a command.

**Parameters**

* **command** (`string`|`array of string`) The command that will be used. 
* **timeout** (`int`) *Optional* By default processes have a timeout of 60 seconds, but you can change it passing a different timeout (in seconds).
* **cwd** (`string`) *Optional* The *current working dir* The directory in which the command will be executed. Current directory by default.

**Return values**

* **output** (`string`) The output of the command executed.

**Examples**

```yaml
actions:
  # Simplified mode: one-line method
  - run: "echo hi user"
    register: result
  - write: "The output was: '{{registered['result']['output']}}'" 
    # The result will be "hi user"
```

A command could be split into command and parameters. This way, parameters will be escaped automatically:

```yaml
actions:
  - run:
      command:
        - "echo"      # Command
        - "hi user"   # parameter #1
```

Setting the timeout and the *current working directory*:

```yaml
actions:
  - run:
      command: "echo hi user"
      timeout: 60
      cwd: "/tmp"
```

### copy_file {#copy_file}

Makes a copy of a single file.

**Parameters**

* **from** (`string`) The origin file.
* **to** (`string`) The target file.

**Return values**

None

**Examples**

```yaml
actions:
  - copy_file:
      from: "/dir1/file.txt"
      to: "/tmp/file.txt"
```

### download_file {#download_file}

Download a file from network.

**Parameters**

* **url** (`string`) The URL of the file.
* **filename** (`string`) The file in which the URL content will be saved.

**Return values**

None

**Examples**

```yaml
actions:
  - download_file: 
      url: "https://phar.phpunit.de/phpunit-8.phar"
      filename: "phpunit.phar"
```

### make_dir {#make_dir}

Makes a directory recursively. On POSIX filesystems, directories are created with a default mode value `0777`.

**Parameters**

* **dir** (`string`) The directory path.
* **mode** (`string`) *Optional* The directory mode. Default: `0777`.

**Return values**

None

**Examples**

```yaml
actions:
  # Simplified mode: one-line method
  - make_dir: "/dir1"
```
Setting the directory mode:

```yaml
steps:
    - actions:
        - make_dir:
            dir: "/dir1"
            mode: 0777
```

### mirror_dir {#mirror_dir}

Copies all the contents of the source directory into the target one.

**Parameters**

* **from** (`string`) The origin directory.
* **to** (`string`) The target directory.

**Return values**

None

**Examples**

```yaml
actions:
  - mirror_dir:
      from: "/dir1"
      to: "/tmp"
```

### read_file {#read_file}

Reads the content of a file or URL address.

**Parameters**

* **filename** (`string`) The file to be read.

**Return values**

* **content** (`string`) The content of the file.

**Examples**

```yaml
actions:
    # Simplified mode: one-line method
  - read_file: "/tmp/hi.txt"
    register: "file_content"
  - write: "{{registered["file_content"]["content"]}}"
```

### remove {#remove}

Deletes files, directories and symlinks.

**Parameters**

(`string`|`array of strings`) A list of files/directories or symlinks.

**Return values**

None

**Examples**

```yaml
 actions:
     # Simplified mode: one-line method
   - remove: "/tmp/hi.txt"
```

Mixing files and directories up:

```yaml
actions:
  - remove: 
      - "/tmp/hi.txt"
      - "/dir1"
      - "/home/user/symlink1.sh"
```

### write_file {#write_file}

Saves the given contents into a file.

**Parameters**

* **filename** (`string`) The file to be written to.
* **content** (`string`) The data to be write into the file.

**Return values**

None

**Examples**

```yaml
actions:
  - write_file:
      filename: "/tmp/hi.txt"
      content: "hi user"
```
