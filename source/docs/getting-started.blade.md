---
title: Getting Started
description: Getting started with Recipe Runner CLI is quite easy
extends: _layouts.documentation
section: content
---

# Getting Started {#getting-started}

RR CLI tool (RR stands for Recipe Runner) is a tool that let you automate
tasks and extend PHP applications by using special YAML files called *recipes*.

> Please, be aware this project is in a early stage so it is subject to change.

## System requirements {#requirements}

To use RR, you need to have PHP (minimum version 7.3) and [Composer](https://getcomposer.org) 
installed on your machine. 

## Installation {#installation}

### Via phar file

Download the [`rr.phar`]( {{$page->phar_file_url}} ) file and store it somewhere on your computer.
If you put it in a directory that is part of your `path`, you can access it globally.
On Unix systems you can even make it executable and invoke it without directly using
the php interpreter.

```bash
$ wget {{ $page->phar_file_url }}
```

Then if you want to run this command from anywhere on your system:

```bash
$ sudo chmod a+x rr.phar
$ sudo mv rr.phar /usr/local/bin/rr
```

Then, just run `rr`.

If you like to install it only for your user and avoid requiring root permissions,
you can use `~/.local/bin` instead (it's available by default on some Linux distributions).

### Via Composer

RR could be installed in a directory with the following steps:

1. Create a new directory:

```bash
$ mkdir rr
```

2. As Recipe Runner is not in a stable status yet, you have to change 
the Composer minimum stability to `dev`:

```bash
$ composer config minimum-stability dev
```

3. Go to your just created directory and install RR using Composer:

```bash
$ cd rr
$ composer require recipe-runner/rr-cli
```

> Make sure `~/.composer/vendor/bin` is in your `$PATH`.

## Run a recipe {#run-a-recipe}

Recipe files use YAML syntax. If you're new to YAML and want to learn more, see ["Learn YAML in five minutes."](https://www.codeproject.com/Articles/1214409/Learn-YAML-in-five-minutes).

A recipe looks like the following:

```yaml
@verbatim
name: "My first recipe"
extra:
  rr:
    packages:
      "recipe-runner/io-module": "1.0.x-dev"
steps:
  - actions:
      - name: "Greeting"
          write: "Hi user. Welcome :)"
      - ask: "How are you? "
          register: "response"
      - write: "The Response was: '{{registered.get('response.response')}}'"
@endverbatim
```

To run the recipe:

1. Copy the previous recipe into a file called `greeting.rr.yml`
2. Run the recipe with the `run` command:

```bash
$ ./vendor/bin/rr run greeting.rr.yml
# or
$ rr run greeting.rr.yml
```
