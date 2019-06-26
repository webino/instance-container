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

class TestFactoryCallbackInstance
{
    public function __construct(\stdClass $obj)
    {
    }
}


Environment::setup();

$instances = new InstanceContainer;

$instances->bind(TestFactoryCallbackInstance::class, function (CreateInstanceEventInterface $event) {
    $instances = $event->getContainer();
    return new TestFactoryCallbackInstance($instances->get(\stdClass::class));
});

$testInstance = $instances->get(TestFactoryCallbackInstance::class);


Assert::type(TestFactoryCallbackInstance::class, $testInstance);
