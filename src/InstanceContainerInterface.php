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

use Psr\Container\ContainerInterface;

/**
 * Interface InstanceContainerInterface
 * @package instance-container
 */
interface InstanceContainerInterface extends ContainerInterface
{
    /**
     * Set entry.
     *
     * @api
     * @param string $id Entry identifier
     * @param mixed $entry Container entry
     * @return void
     */
    public function set(string $id, $entry): void;

    /**
     * Create new entry.
     *
     * @api
     * @param string $class Instance class
     * @param array<int, mixed> $parameter Optional parameters
     * @throws InstanceNotFoundException No entry was found for identifier
     * @throws InstanceContainerException Error while retrieving the entry
     * @return mixed
     */
    public function make(string $class, ...$parameter);
}
