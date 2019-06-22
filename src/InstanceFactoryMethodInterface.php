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
 * Interface InstanceFactoryMethodInterface
 * @package instance-container
 */
interface InstanceFactoryMethodInterface
{
    /**
     * Creates new instance.
     *
     * @api
     * @since 1.0.2
     * @param CreateInstanceEventInterface $event
     * @return mixed
     */
    public static function create(CreateInstanceEventInterface $event);
}
