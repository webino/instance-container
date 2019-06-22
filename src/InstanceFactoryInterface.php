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
 * Interface InstanceFactoryInterface
 * @package instance-container
 */
interface InstanceFactoryInterface
{
    /**
     * Creates new instance.
     *
     * @api
     * @param CreateInstanceEventInterface $event
     * @return mixed
     */
    public function createInstance(CreateInstanceEventInterface $event);
}
