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


Environment::setup();

$instances = new InstanceContainer;


Assert::type(TestFactoryMethodInstance::class, $instances->get(TestFactoryMethodInstance::class));
