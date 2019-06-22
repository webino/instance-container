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

class TestSetInstanceInstance
{

}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->set(TestSetInstanceInstance::class, new TestSetInstanceInstance);

$testInstance = $instances->get(TestSetInstanceInstance::class);


Assert::type(TestSetInstanceInstance::class, $testInstance);
