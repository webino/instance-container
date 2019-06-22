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

interface TestAliasInstanceInterface
{

}

interface TestAliasInstanceAliasInterface extends TestAliasInstanceInterface
{

}

class TestAliasInterfaceInstance implements TestAliasInstanceAliasInterface
{

}


Tester\Environment::setup();

$instances = new InstanceContainer;

$instances->alias(TestAliasInterfaceInstance::class, TestAliasInstanceInterface::class);
$instances->alias(TestAliasInstanceInterface::class, TestAliasInstanceAliasInterface::class);

$testInstance = $instances->get(TestAliasInterfaceInstance::class);
$testAliasInstance = $instances->get(TestAliasInstanceInterface::class);
$testAliasInstanceAlias = $instances->get(TestAliasInstanceAliasInterface::class);


Assert::type(TestAliasInstanceAliasInterface::class, $testInstance);
Assert::type(TestAliasInstanceInterface::class, $testAliasInstance);
Assert::type(TestAliasInstanceAliasInterface::class, $testAliasInstanceAlias);
Assert::same($testInstance, $testAliasInstance);
Assert::same($testInstance, $testAliasInstanceAlias);
Assert::same($testAliasInstance, $testAliasInstanceAlias);
