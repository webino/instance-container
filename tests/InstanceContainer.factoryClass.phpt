<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @noinspection PhpUnhandledExceptionInspection
 *
 * @link        https://github.com/webino/instance-container
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\CreateInstanceEventInterface;
use Webino\InstanceContainer;
use Webino\InstanceFactoryInterface;

class TestFactoryClassFactory implements InstanceFactoryInterface
{
    public function createInstance(CreateInstanceEventInterface $event)
    {
        $container = $event->getContainer();
        return new TestFactoryClassInstance($container->get(\stdClass::class));
    }
}


class TestFactoryClassInstance
{
    public function __construct(\stdClass $obj)
    {
    }
}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->bind(TestFactoryClassInstance::class, TestFactoryClassFactory::class);

$testInstance = $instances->get(TestFactoryClassInstance::class);


Assert::type(TestFactoryClassInstance::class, $testInstance);
