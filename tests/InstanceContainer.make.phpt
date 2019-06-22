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

class TestCreateInstance
{
    public function __construct(stdClass $dependency)
    {
    }
}


Tester\Environment::setup();

$instances = new InstanceContainer;

$testInstance = $instances->make(TestCreateInstance::class, new stdClass);


Assert::type(TestCreateInstance::class, $testInstance);
