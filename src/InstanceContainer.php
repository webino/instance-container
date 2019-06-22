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
 * Class InstanceContainer
 * @package instance-container
 */
class InstanceContainer implements
    EventEmitterInterface,
    InstanceContainerInterface
{
    use EventEmitterTrait;
    use InstanceContainerTrait;

    public function __construct()
    {
        $this->setupInstanceContainer();
    }
}
