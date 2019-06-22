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
use Webino\CreateInstanceEvent;
use Webino\InstanceContainer;

class TestEventInstance
{
    public $testTriggered = false;
}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->on(CreateInstanceEvent::class, function (CreateInstanceEvent $event) {
    /** @var TestEventInstance $instance */
    $instance = $event->getInstance();
    $instance->testTriggered = true;
});

/** @var TestEventInstance $testInstance */
$testInstance = $instances->get(TestEventInstance::class);


Assert::type(TestEventInstance::class, $testInstance);
Assert::true($testInstance->testTriggered);
