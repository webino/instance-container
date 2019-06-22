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

interface TestCustomInstanceInterface
{

}

class TestCustomInterfaceInstance implements TestCustomInstanceInterface
{

}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->alias(TestCustomInterfaceInstance::class, TestCustomInstanceInterface::class);

$testInstance = $instances->get(TestCustomInstanceInterface::class);


Assert::type(TestCustomInterfaceInstance::class, $testInstance);
