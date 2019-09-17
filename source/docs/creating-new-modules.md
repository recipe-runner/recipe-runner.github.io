---
title: "Developers: Create new modules"
description: Creating new modules
extends: _layouts.documentation
section: content
---

# Developers: creating new modules

* [Creating a project for a module](#creating_a_project)
* [The module class](#module_class)
* [Testing a module](#testing)

## Creating a project for a module {#creating_a_project}

1. Create a project based on the starter template:

```bash
$ composer create-project recipe-runner/module-template:1.0.x-dev your-module-name
```

2. Navigate to your new project directory. The structure of the project is the following:

* `src`: source code.
* `tests`: tests suite.

The starter template comes with a module that exposes one method called `print` that let you write a message using
the [`IOInterface`](https://github.com/recipe-runner/recipe-runner/blob/master/src/IO/IOInterface.php).
If you want to run the test suite, type `composer test`. Integration with Travis CI is included out of the box.
If you don't want to use a *continuous integration* system or you want to use another service such as Circle CI, remove
the file `.travis.yml`.

## The module class {#module_class}

Modules are PHP classes that implement [`ModuleInterface`](https://github.com/recipe-runner/recipe-runner/blob/master/src/Module/ModuleInterface.php). The interface let a module exposes its methods and receives the instancies of 
[`ExpressionResolverInterface`](https://github.com/recipe-runner/recipe-runner/blob/master/src/Expression/ExpressionResolverInterface.php)
and [`IOInterface`](https://github.com/recipe-runner/recipe-runner/blob/master/src/IO/IOInterface.php).

For convenience, there is an abstract class called [`ModuleBase`](https://github.com/recipe-runner/recipe-runner/blob/master/src/Module/ModuleBase.php) that implements most of the interface and has some useful methods.

Below down, the module example from the starter template:

```php
namespace RecipeRunner\ModuleName;

use RecipeRunner\RecipeRunner\Module\Invocation\ExecutionResult;
use RecipeRunner\RecipeRunner\Module\Invocation\Method;
use RecipeRunner\RecipeRunner\Module\ModuleBase;
use Yosymfony\Collection\CollectionInterface;

class ModuleClass extends ModuleBase
{
    public function __construct()
    {
        parent::__construct();

        $this->addMethodHandler('print', [$this, 'print']);
    }

    /**
     * Runs a method. This method is part of ModuleInterface.
     */
    public function runMethod(Method $method, CollectionInterface $recipeVariables) : ExecutionResult
    {
        // Usually, you do not have to do anything here.

        return $this->runInternalMethod($method, $recipeVariables);
    }
    
    protected function print(Method $method): ExecutionResult
    {
        $message = $method->getParameterNameOrPosition('message', 0);
        $io = $this->getIO();
        $io->write($message);

        $jsonResponse = \json_encode(['message' => $message]);
        $isSuccessful = true;
 
        return new ExecutionResult($jsonResponse, $isSuccessful);
    }
}
```
### The constructor

Inside the constructor, the method handlers are registered using `addMethodHandler`.
The first parámeter is the public name of the method, the one used in any recipe, and the second
argument is for the callable function: `[$this, 'class-method-name']`. Usually, method handlers
are `protected` methods as you want to see they are properly register in the constructor. That
way, if you want to test a method you have to do it through the method `runMethod`.

> It's important to call the parent constructor so you don't lose any variable initialization.

### The class Method

[This class](https://github.com/recipe-runner/recipe-runner/blob/master/src/Module/Invocation/Method.php)
contains information about the method: name and parameters as well as some useful methods such as
`getParameterNameOrPosition` or `getParameters`. The former returns the parameter that match the name or is in the position passed as argument the latter returns the [collection](https://github.com/yosymfony/collection) of parameters of the method.

### The class ExecutionResult

[This class](https://github.com/recipe-runner/recipe-runner/blob/master/src/Module/Invocation/ExecutionResult.php)
Modules return a data structure that can be registered into a variable (see [actions](/docs/actions/#registering_execution)). That data structure is a JSON with the information the module may consider
appropriate. In the case of the `print` method, `message` is a parameter that contains the text
it displayed.

## Testing a module {#testing}

The starter template contains an [example](https://github.com/recipe-runner/module-template/blob/master/tests/ModuleClassTest.php)
about how to test the method `print`. Support for PHPUnit is included out of the box.

```php
namespace RecipeRunner\ModuleName\Test;

use PHPUnit\Framework\TestCase;
use RecipeRunner\RecipeRunner\IO\IOInterface;
use RecipeRunner\RecipeRunner\Module\Invocation\ExecutionResult;
use RecipeRunner\RecipeRunner\Module\Invocation\Method;
use RecipeRunner\ModuleName\ModuleClass;
use Yosymfony\Collection\MixedCollection;

class ModuleClassTest extends TestCase
{
    /** @var ModuleClass */
    private $module;

    public function setUp(): void
    {
        $IOMock = $this->getMockBuilder(IOInterface::class)->getMock();
        $this->module = new ModuleClass();
        $this->module->setIO($IOMock);
    }

    public function testMethodPrint()
    {
        $message = 'hi';
        $method = new Method('print');
        $method->addParameter('message', $message);

        $executionResult = $this->module->runMethod($method, new MixedCollection());
        
        $this->assertTrue($executionResult->isSuccess());
        $this->assertEquals([
            'message' => $message
        ], $this->getResultAsArray($executionResult));
    }

    private function getResultAsArray(ExecutionResult $result): array
    {
        return \json_decode($result->getJsonResult(), true);
    }
}
```
