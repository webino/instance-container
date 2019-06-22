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

/**
 * Trait CustomInstanceContainerTrait
 * @package instance-container
 */
trait CustomInstanceContainerTrait
{
    /**
     * Creates instance of container event.
     *
     * @param CreateInstanceEvent $event
     * @return CreateInstanceEventInterface
     */
    abstract protected function createInstanceEvent(CreateInstanceEvent $event): CreateInstanceEventInterface;
}
