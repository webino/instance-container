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
 * Interface CreateInstanceEventInterface
 * @package instance-container
 */
interface CreateInstanceEventInterface extends EventInterface
{
    /**
     * Returns instance container.
     *
     * @api
     * @return InstanceContainerInterface
     */
    public function getContainer(): InstanceContainerInterface;

    /**
     * Returns instance class.
     *
     * @api
     * @return string
     */
    public function getClass(): string;

    /**
     * Returns instance creation parameters.
     *
     * @api
     * @return array
     */
    public function getParameters(): array;
}
