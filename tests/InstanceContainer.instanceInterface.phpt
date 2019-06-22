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
use Webino\InstanceContainer;

interface TestInterfaceInstanceInterface
{

}

class TestInterfaceInstance implements TestInterfaceInstanceInterface
{

}


Tester\Environment::setup();

$instances = new InstanceContainer;

$testInstance = $instances->get(TestInterfaceInstanceInterface::class);


Assert::type(TestInterfaceInstance::class, $testInstance);
