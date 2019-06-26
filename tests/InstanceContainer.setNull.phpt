<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino/instance-container
 * @copyright   Copyright (c) 2019 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

use Tester\Assert;
use Tester\Environment;

class TestSetNullInstance
{

}


Environment::setup();

$instances = new InstanceContainer;

$instances->set(TestSetNullInstance::class, null);


Assert::null($instances->get(TestSetNullInstance::class));
