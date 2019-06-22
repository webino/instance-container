# Webino Instance Container

Instance Container implementation.

[![Build Status](https://img.shields.io/travis/webino/instance-container/master.svg?style=for-the-badge)](http://travis-ci.org/webino/instance-container "Master Build Status")
[![Coverage Status](https://img.shields.io/coveralls/github/webino/instance-container/master.svg?style=for-the-badge)](https://coveralls.io/github/webino/instance-container?branch=master "Master Coverage Status")
[![Code Quality](https://img.shields.io/scrutinizer/g/webino/instance-container/master.svg?style=for-the-badge)](https://scrutinizer-ci.com/g/webino/instance-container/?branch=master "Master Code Quality")
[![Latest Stable Version](https://img.shields.io/github/tag/webino/instance-container.svg?label=STABLE&style=for-the-badge)](https://packagist.org/packages/webino/instance-container)


## Recommended usage

Instance container should be used in factories to resolve new class instance dependencies.
It is not recommended to inject it into objects directly.


## Setup
[![PHP from Packagist](https://img.shields.io/packagist/php-v/webino/instance-container.svg?style=for-the-badge)](https://php.net "Required PHP version")

```bash
composer require webino\instance-container
```


## Quick Use

Getting same class instance:
```php
use Webino\InstanceContainer;

class TestInstance
{
}

$instances = new InstanceContainer;

$testInstance = $instances->get(TestInstance::class);
```

Creating new class instance:
```php
use Webino\InstanceContainer;

class TestInstance
{
    public function __construct(stdClass $dependency)
    {
    }
}

$instances = new InstanceContainer;

$testInstance = $instances->make(TestInstance::class, new stdClass);
```

Getting class instance with a factory method:
```php
use Webino\InstanceContainer;
use Webino\CreateInstanceEventInterface;
use Webino\InstanceFactoryMethodInterface;

class TestInstance implements InstanceFactoryMethodInterface
{
    public static function create(CreateInstanceEventInterface $event)
    {
        $container = $event->getContainer();
        return new static($container->get(stdClass::class));
    }
    
    public function __construct(stdClass $dependency)
    {    
    }
}

$instances = new InstanceContainer;

$testInstance = $instances->get(TestInstance::class);
```

Setting class instance:
```php
use Webino\InstanceContainer;

class TestInstance
{
}

$instances = new InstanceContainer;

$instances->set(TestInstance::class, new TestInstance);
```

Unsetting class instance:
```php
use Webino\InstanceContainer;

class TestInstance
{
}

$instances = new InstanceContainer;

$instances->set(TestInstance::class, null);
```

Binding factory class:
```php
use Webino\InstanceContainer;
use Webino\CreateInstanceEventInterface;

class TestInstanceFactory implements InstanceFactoryInterface
{
    public function createInstance(CreateInstanceEventInterface $event)
    {
        $container = $event->getContainer();
        return new TestInstance($container->get(stdClass::class));
    }
}

class TestInstance
{
    public function __construct(stdClass $dependency)
    {    
    }
}

$instances = new InstanceContainer;

$instances->bind(TestInstance::class, TestInstanceFactory::class);

$testInstance = $instances->get(TestInstance::class);
```

Binding callback factory:
```php
use Webino\InstanceContainer;
use Webino\CreateInstanceEventInterface;

class TestInstance
{
    public function __construct(stdClass $dependency)
    {    
    }
}

$instances = new InstanceContainer;

$instances->bind(TestInstance::class, function (CreateInstanceEventInterface $event) {
    $container = $event->getContainer();
    return new TestInstance($container->get(stdClass::class));
});

$testInstance = $instances->get(TestInstance::class);
```

Getting interface default class instance:
```php
use Webino\InstanceContainer;

interface TestInstanceInterface
{
}

class TestInstance implements TestInstanceInterface
{
    public function __construct(stdClass $dependency)
    {    
    }
}

$instances = new InstanceContainer;

$testInstance = $instances->get(TestInstanceInterface::class);
```

Setting alias interface to a class:
```php
use Webino\InstanceContainer;

interface TestAliasInterface
{
}

class TestInstance implements TestAliasInterface
{
    public function __construct(stdClass $dependency)
    {    
    }
}

$instances = new InstanceContainer;

$instances->alias(TestInstance::class, TestAliasInterface::class);

$testInstance = $instances->get(TestAliasInterface::class);
```

Instance creation event handling:
```php
use Webino\InstanceContainer;
use Webino\CreateInstanceEvent;

class TestInstance
{
    public $foo = false;
}

$instances = new InstanceContainer;

$instances->on(CreateInstanceEvent::class, function (CreateInstanceEvent $event) {
    $instance = $event->getInstance();
    $instance->foo = true;
});

$testInstance = $instances->get(TestAliasInterface::class);
```

## API

**InstanceContainer**

- *bool* has(*string* $id) <br>
  Returns true if the container can return an instance for the given identifier, false otherwise.

- *mixed* get(*string* $id) <br>
  Returns entry instance of the container by its identifier.

- *void* set(*string* $id, *mixed* $instance) <br>
  Set entry instance.

- *mixed* make(*string* $id, *array<int, mixed>* ...$parameter) <br>
  Creates new instance.

- *void* bind(*string* $id, *mixed* $binding) <br>
  Bind provider to an entry instance.
  
- *void* alias(*string* $id, *string* $alias) <br>
  Set alias to an entry instance.


**CreateInstanceEvent**

- *InstanceContainerInterface* getContainer() <br>
  Returns instance container.

- *string* getClass() <br>
  Returns instance class.

- *array* getParameters() <br>
  Returns instance creation parameters.


**InstanceFactory**

- *mixed* createInstance(*CreateInstanceEventInterface* $event) <br>
  Creates new instance.
  
  
**InstanceFactoryMethod**

- *mixed* *static* create(*CreateInstanceEventInterface* $event) <br>
  Creates new instance.


## Development

[![Build Status](https://img.shields.io/travis/webino/instance-container/develop.svg?style=for-the-badge)](http://travis-ci.org/webino/instance-container "Develop Build Status")
[![Coverage Status](https://img.shields.io/coveralls/github/webino/instance-container/develop.svg?style=for-the-badge)](https://coveralls.io/github/webino/instance-container?branch=develop "Develop Coverage Status")
[![Code Quality](https://img.shields.io/scrutinizer/g/webino/instance-container/develop.svg?style=for-the-badge)](https://scrutinizer-ci.com/g/webino/instance-container/?branch=develop "Develop Code Quality")
[![Latest Unstable Version](https://img.shields.io/github/tag-pre/webino/instance-container.svg?label=PREVIEW&style=for-the-badge)](https://packagist.org/packages/webino/instance-container "Packagist")


Static analysis:
```bash
composer analyse
```

Coding style check:
```bash
composer check
```

Coding style fix:
```bash 
composer fix
```

Testing:
```bash
composer test
```

Git pre-commit setup:
```bash
ln -s ../../pre-commit .git/hooks/pre-commit
```


## Addendum

[![License](https://img.shields.io/packagist/l/webino/instance-container.svg?style=for-the-badge)](https://github.com/webino/instance-container/blob/master/LICENSE.md "BSD-3-Clause License")
[![Total Downloads](https://img.shields.io/packagist/dt/webino/instance-container.svg?style=for-the-badge)](https://packagist.org/packages/webino/instance-container "Packagist") 
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/webino/instance-container.svg?style=for-the-badge)


  Please, if you are interested in this library report any issues and don't hesitate to contribute.
  We will appreciate any contributions on development of this library.

[![GitHub issues](https://img.shields.io/github/issues/webino/instance-container.svg?style=for-the-badge)](https://github.com/webino/instance-container/issues)
[![GitHub forks](https://img.shields.io/github/forks/webino/instance-container.svg?label=Fork&style=for-the-badge)](https://github.com/webino/instance-container)
