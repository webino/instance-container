<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/instance-container
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\InstanceContainer;

class TestSetNullInstance
{

}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->set(TestSetNullInstance::class, null);


Assert::null($instances->get(TestSetNullInstance::class));
