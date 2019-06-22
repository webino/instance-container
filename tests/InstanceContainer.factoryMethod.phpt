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
use Webino\InstanceFactoryMethodInterface;

class TestFactoryMethodInstance implements InstanceFactoryMethodInterface
{
    public static function create(CreateInstanceEventInterface $event)
    {
        $container = $event->getContainer();
        return new static($container->get(\stdClass::class));
    }

    public function __construct(\stdClass $obj)
    {
    }
}


Tester\Environment::setup();

$instances = new InstanceContainer;


Assert::type(TestFactoryMethodInstance::class, $instances->get(TestFactoryMethodInstance::class));
