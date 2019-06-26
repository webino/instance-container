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

namespace Webino;

use Tester\Assert;
use Tester\Environment;

class TestInstanceFactory implements InstanceFactoryInterface
{
    public function createInstance(CreateInstanceEventInterface $event)
    {
        $container = $event->getContainer();
        return new TestFactoryInstance($container->get(\stdClass::class));
    }
}


class TestFactoryInstance
{
    public function __construct(\stdClass $obj)
    {
    }
}


Environment::setup();

$instances = new InstanceContainer;

$instances->bind(TestFactoryInstance::class, new TestInstanceFactory);

$testInstance = $instances->get(TestFactoryInstance::class);


Assert::type(TestFactoryInstance::class, $testInstance);
